<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{

    /**
     * Display a listing of roles
     */
    public function index(Request $request)
    {
        $query = Role::with(['permissions', 'users']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('display_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $roles = $query->orderBy('name')->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        $permissions = Permission::active()->orderBy('group')->orderBy('display_name')->get()->groupBy('group');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->filled('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rola została utworzona pomyślnie.');
    }

    /**
     * Display the specified role
     */
    public function show(Role $role)
    {
        $role->load(['permissions' => function ($query) {
            $query->orderBy('group')->orderBy('display_name');
        }, 'users']);

        $permissionsByGroup = $role->permissions->groupBy('group');

        return view('admin.roles.show', compact('role', 'permissionsByGroup'));
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit(Role $role)
    {
        $permissions = Permission::active()->orderBy('group')->orderBy('display_name')->get()->groupBy('group');
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions ?? []);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rola została zaktualizowana pomyślnie.');
    }

    /**
     * Remove the specified role
     */
    public function destroy(Role $role)
    {
        if (!$role->canBeDeleted()) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Nie można usunąć roli przypisanej do administratora.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rola została usunięta pomyślnie.');
    }

    /**
     * Assign users to role
     */
    public function assignUsers(Request $request, Role $role)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        foreach ($request->user_ids as $userId) {
            $role->users()->syncWithoutDetaching([
                $userId => [
                    'assigned_by' => auth()->id(),
                    'assigned_at' => now(),
                ]
            ]);
        }

        return redirect()->route('admin.roles.show', $role)
            ->with('success', 'Użytkownicy zostali przypisani do roli.');
    }

    /**
     * Remove user from role
     */
    public function removeUser(Role $role, $userId)
    {
        $role->users()->detach($userId);

        return redirect()->route('admin.roles.show', $role)
            ->with('success', 'Użytkownik został usunięty z roli.');
    }
}