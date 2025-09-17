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

        // Add system note for admin-created account
        $user->addNote(
            'system',
            'Konto utworzone przez administratora',
            'Konto użytkownika zostało utworzone przez administratora w panelu administracyjnym.',
            [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'registration_method' => 'admin_panel',
                'is_admin' => $request->boolean('is_admin', false),
                'assigned_roles' => $request->roles ?? []
            ],
            auth()->user()
        );

        if ($request->filled('roles')) {
            $roleData = [];
            foreach ($request->roles as $roleId) {
                $roleData[$roleId] = [
                    'assigned_by' => auth()->id(),
                    'assigned_at' => now(),
                ];
            }
            $user->roles()->sync($roleData);

            // Add note about role assignment if roles were assigned
            if (count($request->roles) > 0) {
                $roleNames = \App\Models\Role::whereIn('id', $request->roles)->pluck('display_name')->toArray();
                $user->addNote(
                    'permission_change',
                    'Role przypisane przy tworzeniu konta',
                    'Podczas tworzenia konta przypisano następujące role: ' . implode(', ', $roleNames),
                    [
                        'ip' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                        'assigned_roles' => $request->roles,
                        'role_names' => $roleNames
                    ],
                    auth()->user()
                );
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Użytkownik został utworzony pomyślnie.');
    }

    /**
     * Display the specified user
     */
    public function show(Request $request, User $user)
    {
        $user->load(['roles', 'blockedBy', 'notes.createdBy']);

        // If requesting only history for AJAX
        if ($request->has('history_only')) {
            $historyContent = view('admin.users.partials.full-history', compact('user'))->render();
            return response($historyContent);
        }

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
            $oldRoles = $user->roles->pluck('display_name')->toArray();

            $roleData = [];
            foreach ($request->roles ?? [] as $roleId) {
                $roleData[$roleId] = [
                    'assigned_by' => auth()->id(),
                    'assigned_at' => now(),
                ];
            }
            $user->roles()->sync($roleData);

            // Get new roles after sync
            $user->load('roles');
            $newRoles = $user->roles->pluck('display_name')->toArray();

            // Add note about role changes if there were any changes
            if ($oldRoles !== $newRoles) {
                $removedRoles = array_diff($oldRoles, $newRoles);
                $addedRoles = array_diff($newRoles, $oldRoles);

                $changeDescription = [];
                if (!empty($addedRoles)) {
                    $changeDescription[] = 'Dodano role: ' . implode(', ', $addedRoles);
                }
                if (!empty($removedRoles)) {
                    $changeDescription[] = 'Usunięto role: ' . implode(', ', $removedRoles);
                }

                $user->addNote(
                    'permission_change',
                    'Zmiana ról użytkownika',
                    'Administrator zaktualizował role użytkownika. ' . implode('. ', $changeDescription) . '.',
                    [
                        'ip' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                        'old_roles' => $oldRoles,
                        'new_roles' => $newRoles,
                        'added_roles' => array_values($addedRoles),
                        'removed_roles' => array_values($removedRoles)
                    ],
                    auth()->user()
                );
            }
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

    /**
     * Toggle user status (active/blocked)
     */
    public function toggleStatus(User $user)
    {
        if (!$user->canBeBlockedBy(auth()->user())) {
            return redirect()->back()
                ->with('error', 'Nie masz uprawnień do zmiany statusu tego użytkownika.');
        }

        $currentAdmin = auth()->user();

        if ($user->is_active) {
            // Block the user
            $user->update(['is_active' => false]);

            // Add note to history
            $user->addNote(
                'block',
                'Użytkownik został zablokowany',
                'Status użytkownika zmieniony z aktywny na zablokowany przez administratora.',
                [
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'previous_status' => 'active',
                    'new_status' => 'blocked'
                ],
                $currentAdmin
            );

            $message = 'Użytkownik został zablokowany.';
        } else {
            // Unblock the user
            $user->update(['is_active' => true]);

            // Add note to history
            $user->addNote(
                'unblock',
                'Użytkownik został odblokowany',
                'Status użytkownika zmieniony z zablokowany na aktywny przez administratora.',
                [
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'previous_status' => 'blocked',
                    'new_status' => 'active'
                ],
                $currentAdmin
            );

            $message = 'Użytkownik został odblokowany.';
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Add a manual note to user
     */
    public function addNote(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000'
        ]);

        $user->addNote(
            'manual',
            $request->title,
            $request->content,
            [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]
        );

        return redirect()->back()->with('success', 'Notatka została dodana pomyślnie.');
    }

    /**
     * Get user history via AJAX
     */
    public function history(Request $request, User $user)
    {
        $filter = $request->get('filter', 'all');
        $sort = $request->get('sort', 'desc');

        $query = $user->notes()->with('createdBy');

        // Apply filter
        if ($filter !== 'all') {
            $query->where('type', $filter);
        }

        // Apply sort - Laravel handles this at SQL level
        if ($sort === 'asc') {
            $query->orderBy('created_at', 'asc')->orderBy('id', 'asc');
        } else {
            $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');
        }

        $notes = $query->get();

        // Return raw data - let frontend handle sorting and HTML generation
        $data = $notes->map(function($note) {
            // Format metadata dates
            $metadata = $note->metadata ?? [];
            if (isset($metadata['created_at'])) {
                $metadata['created_at'] = \Carbon\Carbon::parse($metadata['created_at'])->format('Y-m-d H:i:s');
            }
            if (isset($metadata['login_time'])) {
                $metadata['login_time'] = \Carbon\Carbon::parse($metadata['login_time'])->format('Y-m-d H:i:s');
            }

            return [
                'id' => $note->id,
                'type' => $note->type,
                'title' => $note->title,
                'content' => $note->content,
                'created_at' => $note->created_at->toISOString(),
                'created_at_formatted' => $note->created_at->format('Y-m-d H:i:s'),
                'metadata' => $metadata,
                'created_by' => $note->createdBy ? [
                    'id' => $note->createdBy->id,
                    'name' => $note->createdBy->name
                ] : null,
                'type_color' => $note->type_color,
                'type_icon' => $note->type_icon,
                'type_name' => $note->type_name
            ];
        });

        return response()->json([
            'notes' => $data,
            'count' => $notes->count()
        ]);
    }
}