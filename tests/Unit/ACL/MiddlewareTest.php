<?php

namespace Tests\Unit\ACL;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_permission_middleware_allows_access_with_permission()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $role = Role::factory()->create();
        $permission = Permission::factory()->create(['name' => 'test.permission']);

        $role->permissions()->attach($permission);
        $user->assignRole($role);

        Auth::login($user);

        $middleware = new CheckPermission();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'test.permission');

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_check_permission_middleware_denies_access_without_permission()
    {
        $user = User::factory()->create(['is_admin' => false]);
        Auth::login($user);

        $middleware = new CheckPermission();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'test.permission');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/dashboard', $response->headers->get('Location'));
    }

    public function test_check_permission_middleware_redirects_unauthenticated_user()
    {
        $middleware = new CheckPermission();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'test.permission');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/login', $response->headers->get('Location'));
    }

    public function test_check_permission_middleware_logs_out_blocked_user()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $admin = User::factory()->create(['is_admin' => true]);

        $user->block('Test reason', $admin);
        Auth::login($user);

        $middleware = new CheckPermission();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'test.permission');

        $this->assertFalse(Auth::check()); // User should be logged out
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/login', $response->headers->get('Location'));
    }

    public function test_check_permission_middleware_allows_superuser()
    {
        $user = User::factory()->create(['email' => 'szymon.guzik@gmail.com']);
        Auth::login($user);

        $middleware = new CheckPermission();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'any.permission');

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_check_permission_middleware_allows_admin()
    {
        $user = User::factory()->create(['is_admin' => true]);
        Auth::login($user);

        $middleware = new CheckPermission();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'any.permission');

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_check_role_middleware_allows_access_with_role()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $role = Role::factory()->create(['name' => 'test-role']);

        $user->assignRole($role);
        Auth::login($user);

        $middleware = new CheckRole();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'test-role');

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_check_role_middleware_denies_access_without_role()
    {
        $user = User::factory()->create(['is_admin' => false]);
        Auth::login($user);

        $middleware = new CheckRole();
        $request = Request::create('/test');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        }, 'test-role');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/dashboard', $response->headers->get('Location'));
    }

    public function test_ensure_user_is_admin_middleware_allows_admin()
    {
        $user = User::factory()->create(['is_admin' => true]);
        Auth::login($user);

        $middleware = new EnsureUserIsAdmin();
        $request = Request::create('/admin');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_ensure_user_is_admin_middleware_allows_superuser()
    {
        $user = User::factory()->create(['email' => 'szymon.guzik@gmail.com', 'is_admin' => false]);
        Auth::login($user);

        $middleware = new EnsureUserIsAdmin();
        $request = Request::create('/admin');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_ensure_user_is_admin_middleware_denies_regular_user()
    {
        $user = User::factory()->create(['is_admin' => false]);
        Auth::login($user);

        $middleware = new EnsureUserIsAdmin();
        $request = Request::create('/admin');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        });

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/dashboard', $response->headers->get('Location'));
    }

    public function test_ensure_user_is_admin_middleware_redirects_unauthenticated()
    {
        $middleware = new EnsureUserIsAdmin();
        $request = Request::create('/admin');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        });

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/login', $response->headers->get('Location'));
    }

    public function test_middleware_logs_out_blocked_admin()
    {
        $admin = User::factory()->create(['is_admin' => true, 'email' => 'admin@test.com']);
        $superuser = User::factory()->create(['email' => 'szymon.guzik@gmail.com']);

        $admin->block('Test reason', $superuser);
        Auth::login($admin);

        $middleware = new EnsureUserIsAdmin();
        $request = Request::create('/admin');

        $response = $middleware->handle($request, function () {
            return new Response('OK');
        });

        $this->assertFalse(Auth::check()); // User should be logged out
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('/login', $response->headers->get('Location'));
    }
}