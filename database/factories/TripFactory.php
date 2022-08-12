<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'location' => $this->faker->text(15),
            'start_date' => $this->faker->dateTime('now', 'UTC'),
            'end_date' => $this->faker->dateTime('now', 'UTC'),
            'batch_size' => $this->faker->randomNumber(0),
            'price' => $this->faker->randomNumber(0),
            'trip_type_id' => \App\Models\TripType::factory(),
        ];
    }
}
