<?php

namespace Tests\Unit\ACL;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_permission_assignment()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(['name' => 'test.permission']);

        $this->assertFalse($role->hasPermission('test.permission'));

        $role->givePermission($permission);

        $this->assertTrue($role->hasPermission('test.permission'));
    }

    public function test_role_permission_revocation()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(['name' => 'test.permission']);

        $role->givePermission($permission);
        $this->assertTrue($role->hasPermission('test.permission'));

        $role->revokePermission($permission);
        $this->assertFalse($role->hasPermission('test.permission'));
    }

    public function test_role_permission_sync()
    {
        $role = Role::factory()->create();
        $permission1 = Permission::factory()->create(['name' => 'test.permission1']);
        $permission2 = Permission::factory()->create(['name' => 'test.permission2']);
        $permission3 = Permission::factory()->create(['name' => 'test.permission3']);

        // Initial assignment
        $role->syncPermissions([$permission1, $permission2]);

        $this->assertTrue($role->hasPermission('test.permission1'));
        $this->assertTrue($role->hasPermission('test.permission2'));
        $this->assertFalse($role->hasPermission('test.permission3'));

        // Sync with different permissions
        $role->syncPermissions([$permission2, $permission3]);

        $this->assertFalse($role->hasPermission('test.permission1'));
        $this->assertTrue($role->hasPermission('test.permission2'));
        $this->assertTrue($role->hasPermission('test.permission3'));
    }

    public function test_role_can_be_deleted_when_not_assigned_to_admin()
    {
        $role = Role::factory()->create();
        $regularUser = User::factory()->create(['is_admin' => false]);

        $this->assertTrue($role->canBeDeleted());

        // Assign to regular user - should still be deletable
        $regularUser->assignRole($role);
        $this->assertTrue($role->canBeDeleted());
    }

    public function test_role_cannot_be_deleted_when_assigned_to_admin()
    {
        $role = Role::factory()->create();
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($role->canBeDeleted());

        // Assign to admin - should not be deletable
        $admin->assignRole($role);
        $this->assertFalse($role->canBeDeleted());
    }

    public function test_inactive_roles_dont_provide_permissions()
    {
        $role = Role::factory()->create(['is_active' => false]);
        $permission = Permission::factory()->create(['name' => 'test.permission']);
        $user = User::factory()->create(['is_admin' => false]);

        $role->givePermission($permission);
        $user->assignRole($role);

        // Inactive role should not provide permissions
        $this->assertFalse($user->hasPermission('test.permission'));

        // Activate role
        $role->update(['is_active' => true]);
        $user->refresh();

        $this->assertTrue($user->hasPermission('test.permission'));
    }

    public function test_role_with_string_permission_assignment()
    {
        $role = Role::factory()->create();
        Permission::factory()->create(['name' => 'test.permission']);

        $role->givePermission('test.permission');

        $this->assertTrue($role->hasPermission('test.permission'));
    }

    public function test_role_permission_relationship()
    {
        $role = Role::factory()->create();
        $permission1 = Permission::factory()->create();
        $permission2 = Permission::factory()->create();

        $role->permissions()->attach([$permission1->id, $permission2->id]);

        $this->assertEquals(2, $role->permissions()->count());
        $this->assertTrue($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));
    }

    public function test_user_role_relationship()
    {
        $role = Role::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $assignedBy = User::factory()->create();

        $user1->assignRole($role, $assignedBy);
        $user2->assignRole($role, $assignedBy);

        $this->assertEquals(2, $role->users()->count());
        $this->assertTrue($role->users->contains($user1));
        $this->assertTrue($role->users->contains($user2));
    }

    public function test_active_scope()
    {
        Role::factory()->create(['is_active' => true]);
        Role::factory()->create(['is_active' => true]);
        Role::factory()->create(['is_active' => false]);

        $activeRoles = Role::active()->get();
        $this->assertEquals(2, $activeRoles->count());
    }
}