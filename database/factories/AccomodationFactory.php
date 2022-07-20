<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Accomodation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccomodationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accomodation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
