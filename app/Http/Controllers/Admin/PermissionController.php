<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{

    /**
     * Display a listing of permissions
     */
    public function index(Request $request)
    {
        $query = Permission::with(['roles']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('display_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $permissions = $query->orderBy('group')->orderBy('name')->paginate(15);
        $groups = Permission::getGroups();

        return view('admin.permissions.index', compact('permissions', 'groups'));
    }

    /**
     * Show the form for creating a new permission
     */
    public function create()
    {
        $groups = Permission::getGroups();
        $groupDisplayNames = Permission::getGroupDisplayNames();

        return view('admin.permissions.create', compact('groups', 'groupDisplayNames'));
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'group' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'group' => $request->group,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Uprawnienie zostało utworzone pomyślnie.');
    }

    /**
     * Display the specified permission
     */
    public function show(Permission $permission)
    {
        $permission->load(['roles' => function ($query) {
            $query->orderBy('name');
        }]);

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit(Permission $permission)
    {
        $groups = Permission::getGroups();
        $groupDisplayNames = Permission::getGroupDisplayNames();

        return view('admin.permissions.edit', compact('permission', 'groups', 'groupDisplayNames'));
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'group' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'group' => $request->group,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Uprawnienie zostało zaktualizowane pomyślnie.');
    }

    /**
     * Remove the specified permission
     */
    public function destroy(Permission $permission)
    {
        if (!$permission->canBeDeleted()) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'Nie można usunąć uprawnienia przypisanego do roli administratora.');
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Uprawnienie zostało usunięte pomyślnie.');
    }

    /**
     * Create CRUD permissions for a group
     */
    public function createCrudPermissions(Request $request)
    {
        $request->validate([
            'group' => 'required|string|max:255',
            'display_group_name' => 'required|string|max:255',
        ]);

        $permissions = Permission::createCrudPermissions($request->group, $request->display_group_name);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Uprawnienia CRUD zostały utworzone dla grupy: ' . $request->display_group_name);
    }

    /**
     * Get permissions grouped by group for AJAX requests
     */
    public function apiGrouped()
    {
        $permissions = Permission::active()
            ->orderBy('group')
            ->orderBy('display_name')
            ->get()
            ->groupBy('group');

        return response()->json($permissions);
    }

    /**
     * Get permissions by group for AJAX requests
     */
    public function apiByGroup(Request $request)
    {
        $request->validate([
            'group' => 'required|string'
        ]);

        $permissions = Permission::active()
            ->where('group', $request->group)
            ->orderBy('display_name')
            ->get();

        return response()->json($permissions);
    }
}