<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $group = $this->faker->randomElement(['blog', 'users', 'roles', 'permissions', 'test']);
        $action = $this->faker->randomElement(['create', 'read', 'update', 'delete']);
        $uniqueId = $this->faker->unique()->randomNumber(5);

        return [
            'name' => $group . '.' . $action . '.' . $uniqueId,
            'display_name' => ucfirst($action) . ' ' . ucfirst($group),
            'description' => $this->faker->sentence(),
            'group' => $group,
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the permission is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Create a permission for a specific group and action.
     */
    public function forGroup(string $group, string $action = 'read'): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $group . '.' . $action,
            'display_name' => ucfirst($action) . ' ' . ucfirst($group),
            'group' => $group,
        ]);
    }
}