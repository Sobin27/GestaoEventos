<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'uuid' => Str::uuid(),
            'email' => fake()->unique()->safeEmail(),
            'login' => fake()->name,
            'email_verified_at' => null,
            'confirmed_email' => false,
            'ativo' => true,
            'created_by' => 'jose.sobreira',
            'updated_by' => 'jose.sobreira'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
