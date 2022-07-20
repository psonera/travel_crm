<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'type' => $this->faker->word,
            'comment' => $this->faker->text,
            'schedule_from' => $this->faker->dateTime,
            'schedule_to' => $this->faker->dateTime,
            'is_done' => $this->faker->numberBetween(0, 127),
            'location' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
