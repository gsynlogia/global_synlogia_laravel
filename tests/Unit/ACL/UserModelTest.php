<?php

namespace Tests\Unit\ACL;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test permissions and roles
        $this->createTestPermissions();
    }

    public function test_superuser_identification()
    {
        // Create superuser (from .env)
        $superuser = User::factory()->create([
            'email' => 'szymon.guzik@gmail.com',
            'is_admin' => false
        ]);

        // Create regular admin
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        // Create regular user
        $user = User::factory()->create([
            'is_admin' => false
        ]);

        $this->assertTrue($superuser->isSuperuser());
        $this->assertTrue($superuser->isAdmin()); // Superuser is always admin

        $this->assertFalse($admin->isSuperuser());
        $this->assertTrue($admin->isAdmin());

        $this->assertFalse($user->isSuperuser());
        $this->assertFalse($user->isAdmin());
    }

    public function test_permission_checking()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(['name' => 'test.permission.check']);

        // User without role/permission should not have permission
        $this->assertFalse($user->hasPermission('test.permission.check'));

        // Assign role to user and permission to role
        $role->permissions()->attach($permission);
        $user->assignRole($role);

        $this->assertTrue($user->hasPermission('test.permission.check'));
        $this->assertFalse($user->hasPermission('nonexistent.permission'));
    }

    public function test_superuser_has_all_permissions()
    {
        $superuser = User::factory()->create([
            'email' => 'szymon.guzik@gmail.com'
        ]);

        // Superuser should have any permission without explicit assignment
        $this->assertTrue($superuser->hasPermission('any.permission'));
        $this->assertTrue($superuser->hasPermission('blog.create'));
        $this->assertTrue($superuser->hasPermission('users.delete'));
    }

    public function test_admin_has_all_permissions()
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        // Admin should have any permission without explicit assignment
        $this->assertTrue($admin->hasPermission('any.permission'));
        $this->assertTrue($admin->hasPermission('blog.create'));
        $this->assertTrue($admin->hasPermission('users.delete'));
    }

    public function test_blocked_user_has_no_permissions()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(['name' => 'test.permission.blocked']);

        // Setup user with permission
        $role->permissions()->attach($permission);
        $user->assignRole($role);
        $this->assertTrue($user->hasPermission('test.permission.blocked'));

        // Block user
        $user->block('Test reason');
        $this->assertFalse($user->hasPermission('test.permission.blocked'));
    }

    public function test_role_assignment()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'test-role']);
        $assignedBy = User::factory()->create();

        $this->assertFalse($user->hasRole('test-role'));

        $user->assignRole($role, $assignedBy);

        $this->assertTrue($user->hasRole('test-role'));

        // Check pivot data
        $pivot = $user->roles()->where('role_id', $role->id)->first()->pivot;
        $this->assertEquals($assignedBy->id, $pivot->assigned_by);
        $this->assertNotNull($pivot->assigned_at);
    }

    public function test_role_removal()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'test-role']);

        $user->assignRole($role);
        $this->assertTrue($user->hasRole('test-role'));

        $user->removeRole($role);
        $this->assertFalse($user->hasRole('test-role'));
    }

    public function test_blocking_functionality()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertFalse($user->isBlocked());

        $user->block('Test reason', $admin);

        $this->assertTrue($user->isBlocked());
        $this->assertEquals('Test reason', $user->block_reason);
        $this->assertEquals($admin->id, $user->blocked_by);
        $this->assertNotNull($user->blocked_at);

        $user->unblock();

        $this->assertFalse($user->isBlocked());
        $this->assertNull($user->block_reason);
        $this->assertNull($user->blocked_by);
        $this->assertNull($user->blocked_at);
    }

    public function test_deletion_permissions()
    {
        $superuser = User::factory()->create(['email' => 'szymon.guzik@gmail.com']);
        $admin = User::factory()->create(['is_admin' => true]);
        $regularUser = User::factory()->create();
        $otherAdmin = User::factory()->create(['is_admin' => true]);

        // Superuser can delete anyone except other superusers
        $this->assertTrue($admin->canBeDeletedBy($superuser));
        $this->assertTrue($regularUser->canBeDeletedBy($superuser));
        $this->assertFalse($superuser->canBeDeletedBy($superuser)); // Cannot delete self if superuser

        // Admin can delete regular users but not other admins
        $this->assertTrue($regularUser->canBeDeletedBy($admin));
        $this->assertFalse($otherAdmin->canBeDeletedBy($admin));
        $this->assertFalse($superuser->canBeDeletedBy($admin));

        // Regular user cannot delete anyone
        $this->assertFalse($admin->canBeDeletedBy($regularUser));
        $this->assertFalse($regularUser->canBeDeletedBy($regularUser));
    }

    public function test_blocking_permissions()
    {
        $superuser = User::factory()->create(['email' => 'szymon.guzik@gmail.com']);
        $admin = User::factory()->create(['is_admin' => true]);
        $regularUser = User::factory()->create();
        $otherAdmin = User::factory()->create(['is_admin' => true]);

        // Superuser can block anyone except other superusers
        $this->assertTrue($admin->canBeBlockedBy($superuser));
        $this->assertTrue($regularUser->canBeBlockedBy($superuser));
        $this->assertFalse($superuser->canBeBlockedBy($superuser)); // Cannot block self if superuser

        // Admin can block regular users but not other admins
        $this->assertTrue($regularUser->canBeBlockedBy($admin));
        $this->assertFalse($otherAdmin->canBeBlockedBy($admin));
        $this->assertFalse($superuser->canBeBlockedBy($admin));

        // Regular user cannot block anyone
        $this->assertFalse($admin->canBeBlockedBy($regularUser));
        $this->assertFalse($regularUser->canBeBlockedBy($regularUser));
    }

    public function test_multiple_permissions_check()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $permission1 = Permission::factory()->create(['name' => 'test.permission1']);
        $permission2 = Permission::factory()->create(['name' => 'test.permission2']);
        $permission3 = Permission::factory()->create(['name' => 'test.permission3']);

        $role->permissions()->attach([$permission1->id, $permission2->id]);
        $user->assignRole($role);

        // Test hasAnyPermission
        $this->assertTrue($user->hasAnyPermission(['test.permission1', 'test.permission3']));
        $this->assertFalse($user->hasAnyPermission(['test.permission3', 'nonexistent.permission']));

        // Test hasAllPermissions
        $this->assertTrue($user->hasAllPermissions(['test.permission1', 'test.permission2']));
        $this->assertFalse($user->hasAllPermissions(['test.permission1', 'test.permission3']));
    }

    private function createTestPermissions()
    {
        // Create some test permissions for the test database
        Permission::factory()->create(['name' => 'blog.create', 'group' => 'blog']);
        Permission::factory()->create(['name' => 'users.delete', 'group' => 'users']);
        Permission::factory()->create(['name' => 'test.permission', 'group' => 'test']);
    }
}