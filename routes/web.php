<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MagicLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\BlogController as PublicBlogController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/o-firmie', function () {
    return view('pages.about');
});

Route::get('/uslugi', function () {
    return view('pages.services');
});

Route::get('/kontakt', function () {
    return view('pages.contact');
});

Route::get('/blog', function () {
    return view('pages.blog');
});

// Authentication routes
Route::get('/login', [MagicLinkController::class, 'showLinkRequestForm'])->name('login')->middleware('guest');
Route::post('/login', [MagicLinkController::class, 'sendMagicLink'])->name('login.send')->middleware('guest');
Route::get('/auth/verify/{token}', [MagicLinkController::class, 'verifyMagicLink'])->name('auth.verify');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('/logout', [MagicLinkController::class, 'logout'])->name('logout');
});

// Admin routes (only for superusers)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    // User management routes
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:users.read')->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->middleware('permission:users.create')->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->middleware('permission:users.create')->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->middleware('permission:users.read')->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:users.update')->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->middleware('permission:users.update')->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('permission:users.delete')->name('users.destroy');
    Route::delete('/users/{user}/force', [UserController::class, 'forceDestroy'])->middleware('permission:users.force_delete')->name('users.force-destroy');
    Route::post('/users/{user}/restore', [UserController::class, 'restore'])->middleware('permission:users.restore')->name('users.restore');
    Route::post('/users/{user}/block', [UserController::class, 'block'])->middleware('permission:users.block')->name('users.block');
    Route::post('/users/{user}/unblock', [UserController::class, 'unblock'])->middleware('permission:users.block')->name('users.unblock');
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->middleware('permission:users.block')->name('users.toggle-status');
    Route::get('/users/blocked/list', [UserController::class, 'blocked'])->middleware('permission:users.read')->name('users.blocked');
    Route::get('/users/trash/list', [UserController::class, 'trash'])->middleware('permission:users.read')->name('users.trash');
    Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->middleware('permission:roles.assign')->name('users.assign-role');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->middleware('permission:roles.assign')->name('users.remove-role');
    Route::post('/users/{user}/add-note', [UserController::class, 'addNote'])->middleware('permission:users.update')->name('users.add-note');
    Route::get('/users/{user}/history', [UserController::class, 'history'])->middleware('permission:users.read')->name('users.history');

    // Role management routes
    Route::get('/roles', [RoleController::class, 'index'])->middleware('permission:roles.read')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->middleware('permission:roles.create')->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->middleware('permission:roles.create')->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->middleware('permission:roles.read')->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:roles.update')->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('permission:roles.update')->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:roles.delete')->name('roles.destroy');
    Route::post('/roles/{role}/assign-users', [RoleController::class, 'assignUsers'])->middleware('permission:roles.assign')->name('roles.assign-users');
    Route::delete('/roles/{role}/users/{user}', [RoleController::class, 'removeUser'])->middleware('permission:roles.assign')->name('roles.remove-user');

    // Permission management routes
    Route::get('/permissions', [PermissionController::class, 'index'])->middleware('permission:permissions.read')->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->middleware('permission:permissions.create')->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->middleware('permission:permissions.create')->name('permissions.store');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->middleware('permission:permissions.read')->name('permissions.show');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->middleware('permission:permissions.update')->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->middleware('permission:permissions.update')->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:permissions.delete')->name('permissions.destroy');
    Route::post('/permissions/crud', [PermissionController::class, 'createCrudPermissions'])->middleware('permission:permissions.create')->name('permissions.create-crud');

    // Blog management routes - explicite routing dla ID
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->where('id', '[0-9]+')->name('blog.show');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->where('id', '[0-9]+')->name('blog.edit');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->where('id', '[0-9]+')->name('blog.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->where('id', '[0-9]+')->name('blog.destroy');
    Route::patch('/blog/{id}/restore', [BlogController::class, 'restore'])->name('blog.restore');

    // API routes for AJAX requests
    Route::get('/api/users', [UserController::class, 'apiIndex'])->name('api.users');
    Route::get('/api/permissions/grouped', [PermissionController::class, 'apiGrouped'])->name('api.permissions.grouped');
    Route::get('/api/permissions/by-group', [PermissionController::class, 'apiByGroup'])->name('api.permissions.by-group');
});

// Public blog routes
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blogPost}', [PublicBlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{blogPost}/password', [PublicBlogController::class, 'checkPassword'])->name('blog.password');
