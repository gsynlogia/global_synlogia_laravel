<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionGroups = [
            'blog' => 'Blog',
            'training' => 'Szkolenia',
            'contact' => 'Kontakt',
            'slider' => 'Slider',
            'badge_slider' => 'Badge Slider',
            'services' => 'Usługi',
            'technologies' => 'Technologie',
        ];

        // Create CRUD permissions for each group
        foreach ($permissionGroups as $group => $displayName) {
            Permission::createCrudPermissions($group, $displayName);
        }

        // Create additional user management permissions
        $userPermissions = [
            [
                'name' => 'users.create',
                'display_name' => 'Tworzenie - Użytkownicy',
                'description' => 'Tworzenie nowych użytkowników w systemie',
                'group' => 'users',
            ],
            [
                'name' => 'users.read',
                'display_name' => 'Przeglądanie - Użytkownicy',
                'description' => 'Przeglądanie listy użytkowników',
                'group' => 'users',
            ],
            [
                'name' => 'users.update',
                'display_name' => 'Edycja - Użytkownicy',
                'description' => 'Edycja danych użytkowników',
                'group' => 'users',
            ],
            [
                'name' => 'users.delete',
                'display_name' => 'Usuwanie (miękkie) - Użytkownicy',
                'description' => 'Miękkie usuwanie użytkowników (soft delete)',
                'group' => 'users',
            ],
            [
                'name' => 'users.force_delete',
                'display_name' => 'Usuwanie (twarde) - Użytkownicy',
                'description' => 'Trwałe usuwanie użytkowników z bazy danych',
                'group' => 'users',
            ],
            [
                'name' => 'users.restore',
                'display_name' => 'Przywracanie - Użytkownicy',
                'description' => 'Przywracanie usuniętych użytkowników',
                'group' => 'users',
            ],
            [
                'name' => 'users.block',
                'display_name' => 'Blokowanie - Użytkownicy',
                'description' => 'Blokowanie i odblokowywanie użytkowników',
                'group' => 'users',
            ],
        ];

        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                [
                    'display_name' => $permission['display_name'],
                    'description' => $permission['description'],
                    'group' => $permission['group'],
                    'is_active' => true,
                ]
            );
        }

        // Create role management permissions
        $rolePermissions = [
            [
                'name' => 'roles.create',
                'display_name' => 'Tworzenie - Role',
                'description' => 'Tworzenie nowych ról w systemie',
                'group' => 'roles',
            ],
            [
                'name' => 'roles.read',
                'display_name' => 'Przeglądanie - Role',
                'description' => 'Przeglądanie listy ról',
                'group' => 'roles',
            ],
            [
                'name' => 'roles.update',
                'display_name' => 'Edycja - Role',
                'description' => 'Edycja ról i przypisywanie uprawnień',
                'group' => 'roles',
            ],
            [
                'name' => 'roles.delete',
                'display_name' => 'Usuwanie - Role',
                'description' => 'Usuwanie ról z systemu',
                'group' => 'roles',
            ],
            [
                'name' => 'roles.assign',
                'display_name' => 'Przypisywanie - Role',
                'description' => 'Przypisywanie i odbieranie ról użytkownikom',
                'group' => 'roles',
            ],
        ];

        foreach ($rolePermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                [
                    'display_name' => $permission['display_name'],
                    'description' => $permission['description'],
                    'group' => $permission['group'],
                    'is_active' => true,
                ]
            );
        }

        // Create permission management permissions
        $permissionPermissions = [
            [
                'name' => 'permissions.create',
                'display_name' => 'Tworzenie - Uprawnienia',
                'description' => 'Tworzenie nowych uprawnień w systemie',
                'group' => 'permissions',
            ],
            [
                'name' => 'permissions.read',
                'display_name' => 'Przeglądanie - Uprawnienia',
                'description' => 'Przeglądanie listy uprawnień',
                'group' => 'permissions',
            ],
            [
                'name' => 'permissions.update',
                'display_name' => 'Edycja - Uprawnienia',
                'description' => 'Edycja uprawnień w systemie',
                'group' => 'permissions',
            ],
            [
                'name' => 'permissions.delete',
                'display_name' => 'Usuwanie - Uprawnienia',
                'description' => 'Usuwanie uprawnień z systemu',
                'group' => 'permissions',
            ],
        ];

        foreach ($permissionPermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                [
                    'display_name' => $permission['display_name'],
                    'description' => $permission['description'],
                    'group' => $permission['group'],
                    'is_active' => true,
                ]
            );
        }

        // Create trash management permissions
        $trashPermissions = [
            [
                'name' => 'trash.read',
                'display_name' => 'Przeglądanie - Kosz',
                'description' => 'Przeglądanie usuniętych elementów w koszu',
                'group' => 'trash',
            ],
            [
                'name' => 'trash.restore',
                'display_name' => 'Przywracanie - Kosz',
                'description' => 'Przywracanie usuniętych elementów z kosza',
                'group' => 'trash',
            ],
            [
                'name' => 'trash.force_delete',
                'display_name' => 'Usuwanie trwałe - Kosz',
                'description' => 'Trwałe usuwanie elementów z kosza',
                'group' => 'trash',
            ],
            [
                'name' => 'trash.empty',
                'display_name' => 'Opróżnianie - Kosz',
                'description' => 'Opróżnianie całego kosza',
                'group' => 'trash',
            ],
        ];

        foreach ($trashPermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                [
                    'display_name' => $permission['display_name'],
                    'description' => $permission['description'],
                    'group' => $permission['group'],
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('Permissions created successfully!');
        $this->command->info('Total permissions created: ' . Permission::count());
    }
}