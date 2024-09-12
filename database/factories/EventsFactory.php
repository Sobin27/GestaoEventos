<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Events>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text,
            'type' => $this->faker->randomElement(['Publica', 'Privada']),
            'event_organizer' => User::factory()->createOne()->id,
            'organizing_company' => $this->faker->company,
            'active' => $this->faker->boolean,
            'max_participants' => $this->faker->numberBetween(10, 1000),
            'duration_time' => $this->faker->numberBetween(1, 8) . ' horas',
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 year')->format('Y-m-d H:i:s'),
        ];
    }
}
