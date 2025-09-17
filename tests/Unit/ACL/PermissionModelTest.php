<?php

namespace Tests\Unit\ACL;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_can_be_deleted_when_not_assigned_to_admin()
    {
        $permission = Permission::factory()->create();
        $role = Role::factory()->create();
        $regularUser = User::factory()->create(['is_admin' => false]);

        $this->assertTrue($permission->canBeDeleted());

        // Assign to role with regular user
        $role->permissions()->attach($permission);
        $regularUser->assignRole($role);

        $this->assertTrue($permission->canBeDeleted());
    }

    public function test_permission_cannot_be_deleted_when_assigned_to_admin()
    {
        $permission = Permission::factory()->create();
        $role = Role::factory()->create();
        $admin = User::factory()->create(['is_admin' => true]);

        $this->assertTrue($permission->canBeDeleted());

        // Assign to role with admin user
        $role->permissions()->attach($permission);
        $admin->assignRole($role);

        $this->assertFalse($permission->canBeDeleted());
    }

    public function test_create_crud_permissions()
    {
        $permissions = Permission::createCrudPermissions('test_module', 'Test Module');

        $this->assertEquals(6, count($permissions));

        $expectedPermissions = [
            'test_module.create',
            'test_module.read',
            'test_module.update',
            'test_module.delete',
            'test_module.force_delete',
            'test_module.restore'
        ];

        foreach ($expectedPermissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            $this->assertNotNull($permission);
            $this->assertEquals('test_module', $permission->group);
            $this->assertTrue($permission->is_active);
        }
    }

    public function test_get_groups()
    {
        Permission::factory()->create(['group' => 'blog', 'is_active' => true]);
        Permission::factory()->create(['group' => 'users', 'is_active' => true]);
        Permission::factory()->create(['group' => 'blog', 'is_active' => true]); // Duplicate group
        Permission::factory()->create(['group' => 'inactive', 'is_active' => false]); // Inactive

        $groups = Permission::getGroups();

        $this->assertContains('blog', $groups);
        $this->assertContains('users', $groups);
        $this->assertNotContains('inactive', $groups); // Inactive permissions excluded
        $this->assertEquals(['blog', 'users'], array_values($groups)); // Sorted and unique
    }

    public function test_get_grouped_permissions()
    {
        Permission::factory()->create(['name' => 'blog.create', 'group' => 'blog', 'display_name' => 'A Blog Create']);
        Permission::factory()->create(['name' => 'blog.read', 'group' => 'blog', 'display_name' => 'B Blog Read']);
        Permission::factory()->create(['name' => 'users.create', 'group' => 'users', 'display_name' => 'A Users Create']);

        $grouped = Permission::getGroupedPermissions();

        $this->assertArrayHasKey('blog', $grouped);
        $this->assertArrayHasKey('users', $grouped);
        $this->assertEquals(2, count($grouped['blog']));
        $this->assertEquals(1, count($grouped['users']));
    }

    public function test_active_scope()
    {
        Permission::factory()->create(['is_active' => true]);
        Permission::factory()->create(['is_active' => true]);
        Permission::factory()->create(['is_active' => false]);

        $activePermissions = Permission::active()->get();
        $this->assertEquals(2, $activePermissions->count());
    }

    public function test_in_group_scope()
    {
        Permission::factory()->create(['group' => 'blog']);
        Permission::factory()->create(['group' => 'blog']);
        Permission::factory()->create(['group' => 'users']);

        $blogPermissions = Permission::inGroup('blog')->get();
        $this->assertEquals(2, $blogPermissions->count());
    }

    public function test_in_groups_scope()
    {
        Permission::factory()->create(['group' => 'blog']);
        Permission::factory()->create(['group' => 'users']);
        Permission::factory()->create(['group' => 'roles']);
        Permission::factory()->create(['group' => 'other']);

        $permissions = Permission::inGroups(['blog', 'users'])->get();
        $this->assertEquals(2, $permissions->count());
    }

    public function test_group_display_names()
    {
        $displayNames = Permission::getGroupDisplayNames();

        $this->assertArrayHasKey('blog', $displayNames);
        $this->assertArrayHasKey('users', $displayNames);
        $this->assertArrayHasKey('roles', $displayNames);
        $this->assertEquals('Blog', $displayNames['blog']);
        $this->assertEquals('Użytkownicy', $displayNames['users']);
    }

    public function test_permission_role_relationship()
    {
        $permission = Permission::factory()->create();
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();

        $permission->roles()->attach([$role1->id, $role2->id]);

        $this->assertEquals(2, $permission->roles()->count());
        $this->assertTrue($permission->roles->contains($role1));
        $this->assertTrue($permission->roles->contains($role2));
    }

    public function test_inactive_permissions_dont_provide_access()
    {
        $permission = Permission::factory()->create(['name' => 'test.permission', 'is_active' => false]);
        $role = Role::factory()->create(['is_active' => true]);
        $user = User::factory()->create(['is_admin' => false]);

        $role->permissions()->attach($permission);
        $user->assignRole($role);

        // Inactive permission should not provide access
        $this->assertFalse($user->hasPermission('test.permission'));

        // Activate permission
        $permission->update(['is_active' => true]);
        $user->refresh();

        $this->assertTrue($user->hasPermission('test.permission'));
    }
}