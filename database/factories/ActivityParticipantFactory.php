<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ActivityParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivityParticipant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomNumber,
            'lead_manager_id' => $this->faker->randomNumber,
            'activity_id' => \App\Models\Activity::factory(),
        ];
    }
}
