<?php
namespace Database\Factories;

use App\Models\Events;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventAddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->word(),
            'country' => $this->faker->country(),
            'event_id' => Events::factory()->createOne()->id,
        ];
    }
}
