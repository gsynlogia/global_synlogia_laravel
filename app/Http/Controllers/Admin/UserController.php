<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::with(['roles', 'blockedBy']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            switch ($request->status) {
                case 'active':
                    $query->active();
                    break;
                case 'blocked':
                    $query->blocked();
                    break;
                case 'admin':
                    $query->admins();
                    break;
                case 'regular':
                    $query->regularUsers();
                    break;
            }
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->orderBy('name')->paginate(15);
        $roles = Role::active()->orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $roles = Role::active()->orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->boolean('is_admin', false),
        ]);

        if ($request->filled('roles')) {
            $roleData = [];
            foreach ($request->roles as $roleId) {
                $roleData[$roleId] = [
                    'assigned_by' => auth()->id(),
                    'assigned_at' => now(),
                ];
            }
            $user->roles()->sync($roleData);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został utworzony pomyślnie.');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load(['roles', 'blockedBy']);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $roles = Role::active()->orderBy('name')->get();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->boolean('is_admin', false),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        if ($request->has('roles')) {
            $roleData = [];
            foreach ($request->roles ?? [] as $roleId) {
                $roleData[$roleId] = [
                    'assigned_by' => auth()->id(),
                    'assigned_at' => now(),
                ];
            }
            $user->roles()->sync($roleData);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został zaktualizowany pomyślnie.');
    }

    /**
     * Soft delete the specified user
     */
    public function destroy(User $user)
    {
        if (!$user->canBeDeletedBy(auth()->user())) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Nie masz uprawnień do usunięcia tego użytkownika.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został usunięty (soft delete).');
    }

    /**
     * Force delete the specified user
     */
    public function forceDestroy(User $user)
    {
        if (!$user->canBeForceDeletedBy(auth()->user())) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Nie masz uprawnień do trwałego usunięcia tego użytkownika.');
        }

        $userName = $user->name;
        $user->forceDelete();

        return redirect()->route('admin.users.index')
            ->with('success', "Użytkownik {$userName} został trwale usunięty.");
    }

    /**
     * Restore a soft deleted user
     */
    public function restore($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został przywrócony pomyślnie.');
    }

    /**
     * Block a user
     */
    public function block(Request $request, User $user)
    {
        if (!$user->canBeBlockedBy(auth()->user())) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Nie masz uprawnień do zablokowania tego użytkownika.');
        }

        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        $user->block($request->reason, auth()->user());

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został zablokowany.');
    }

    /**
     * Unblock a user
     */
    public function unblock(User $user)
    {
        if (!$user->canBeBlockedBy(auth()->user())) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Nie masz uprawnień do odblokowania tego użytkownika.');
        }

        $user->unblock();

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został odblokowany.');
    }

    /**
     * Show blocked users
     */
    public function blocked(Request $request)
    {
        $query = User::blocked()->with(['roles', 'blockedBy']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('blocked_at', 'desc')->paginate(15);

        return view('admin.users.blocked', compact('users'));
    }

    /**
     * Show trash (soft deleted users)
     */
    public function trash(Request $request)
    {
        $query = User::onlyTrashed()->with(['roles', 'blockedBy']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('deleted_at', 'desc')->paginate(15);

        return view('admin.users.trash', compact('users'));
    }

    /**
     * Assign role to user
     */
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role, auth()->user());

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Rola została przypisana do użytkownika.');
    }

    /**
     * Remove role from user
     */
    public function removeRole(User $user, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $user->removeRole($role);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Rola została usunięta z użytkownika.');
    }

    /**
     * Get users data for AJAX requests
     */
    public function apiIndex(Request $request)
    {
        $query = User::select(['id', 'name', 'email', 'is_admin', 'is_blocked']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('exclude_admin') && $request->exclude_admin) {
            $query->where('is_admin', false);
        }

        $users = $query->limit(20)->get();

        return response()->json($users);
    }
}