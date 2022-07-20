<?php

namespace Database\Factories;

use App\Models\LeadType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadType::class;

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
