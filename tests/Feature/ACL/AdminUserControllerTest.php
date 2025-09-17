<?php

namespace Tests\Feature\ACL;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $superuser;
    protected $admin;
    protected $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superuser = User::factory()->create(['email' => 'szymon.guzik@gmail.com']);
        $this->admin = User::factory()->create(['is_admin' => true]);
        $this->regularUser = User::factory()->create(['is_admin' => false]);
    }

    public function test_admin_can_view_users_index()
    {
        $response = $this->actingAs($this->admin)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    public function test_regular_user_cannot_access_users_index()
    {
        $response = $this->actingAs($this->regularUser)->get('/admin/users');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }

    public function test_superuser_can_create_user()
    {
        $role = Role::factory()->create();

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'is_admin' => false,
            'roles' => [$role->id]
        ];

        $response = $this->actingAs($this->superuser)->post('/admin/users', $userData);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => false
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue($user->hasRole($role->name));
    }

    public function test_admin_can_soft_delete_regular_user()
    {
        $response = $this->actingAs($this->admin)
            ->delete("/admin/users/{$this->regularUser->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->assertSoftDeleted('users', ['id' => $this->regularUser->id]);
    }

    public function test_admin_cannot_delete_other_admin()
    {
        $otherAdmin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($this->admin)
            ->delete("/admin/users/{$otherAdmin->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id' => $otherAdmin->id, 'deleted_at' => null]);
    }

    public function test_superuser_can_force_delete_user()
    {
        $this->regularUser->delete(); // Soft delete first

        $response = $this->actingAs($this->superuser)
            ->delete("/admin/users/{$this->regularUser->id}/force");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $this->regularUser->id]);
    }

    public function test_admin_can_block_regular_user()
    {
        $blockData = [
            'reason' => 'Test blocking reason'
        ];

        $response = $this->actingAs($this->admin)
            ->post("/admin/users/{$this->regularUser->id}/block", $blockData);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->regularUser->refresh();
        $this->assertTrue($this->regularUser->isBlocked());
        $this->assertEquals('Test blocking reason', $this->regularUser->block_reason);
        $this->assertEquals($this->admin->id, $this->regularUser->blocked_by);
    }

    public function test_admin_cannot_block_other_admin()
    {
        $otherAdmin = User::factory()->create(['is_admin' => true]);

        $blockData = [
            'reason' => 'Test blocking reason'
        ];

        $response = $this->actingAs($this->admin)
            ->post("/admin/users/{$otherAdmin->id}/block", $blockData);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error');

        $otherAdmin->refresh();
        $this->assertFalse($otherAdmin->isBlocked());
    }

    public function test_admin_can_unblock_user()
    {
        $this->regularUser->block('Test reason', $this->admin);

        $response = $this->actingAs($this->admin)
            ->post("/admin/users/{$this->regularUser->id}/unblock");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->regularUser->refresh();
        $this->assertFalse($this->regularUser->isBlocked());
    }

    public function test_admin_can_restore_soft_deleted_user()
    {
        $this->regularUser->delete();

        $response = $this->actingAs($this->admin)
            ->post("/admin/users/{$this->regularUser->id}/restore");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');

        $this->regularUser->refresh();
        $this->assertNull($this->regularUser->deleted_at);
    }

    public function test_admin_can_view_blocked_users()
    {
        $this->regularUser->block('Test reason', $this->admin);

        $response = $this->actingAs($this->admin)->get('/admin/users/blocked/list');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.blocked');
        $response->assertSee($this->regularUser->name);
    }

    public function test_admin_can_view_trash()
    {
        $this->regularUser->delete();

        $response = $this->actingAs($this->admin)->get('/admin/users/trash/list');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.trash');
        $response->assertSee($this->regularUser->name);
    }

    public function test_admin_can_assign_role_to_user()
    {
        $role = Role::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post("/admin/users/{$this->regularUser->id}/assign-role", [
                'role_id' => $role->id
            ]);

        $response->assertStatus(302);
        $response->assertRedirect("/admin/users/{$this->regularUser->id}");
        $response->assertSessionHas('success');

        $this->assertTrue($this->regularUser->hasRole($role->name));
    }

    public function test_admin_can_remove_role_from_user()
    {
        $role = Role::factory()->create();
        $this->regularUser->assignRole($role);

        $response = $this->actingAs($this->admin)
            ->delete("/admin/users/{$this->regularUser->id}/roles/{$role->id}");

        $response->assertStatus(302);
        $response->assertRedirect("/admin/users/{$this->regularUser->id}");
        $response->assertSessionHas('success');

        $this->assertFalse($this->regularUser->hasRole($role->name));
    }

    public function test_user_update_validation()
    {
        $response = $this->actingAs($this->admin)
            ->put("/admin/users/{$this->regularUser->id}", [
                'name' => '',
                'email' => 'invalid-email',
                'password' => '123', // Too short
                'password_confirmation' => '456' // Doesn't match
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_user_creation_validation()
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/users', [
                'name' => '',
                'email' => $this->regularUser->email, // Duplicate
                'password' => '123',
                'password_confirmation' => '456'
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}