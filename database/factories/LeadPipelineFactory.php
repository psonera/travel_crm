<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\LeadPipeline;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadPipelineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadPipeline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
            'is_default' => $this->faker->numberBetween(0, 127),
            'rotten_days' => $this->faker->randomNumber(0),
        ];
    }
}
