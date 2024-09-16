<?php
namespace Database\Factories;

use App\Models\Events;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id' => Events::factory()->createOne()->id,
            'participant_id' => User::factory()->createOne()->id,
        ];
    }
}
