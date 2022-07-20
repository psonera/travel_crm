<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\LeadPipelineStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadPipelineStageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadPipelineStage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique->text(255),
            'name' => $this->faker->unique->name,
            'probability' => $this->faker->randomNumber(0),
            'sort_order' => $this->faker->randomNumber(0),
            'lead_pipeline_id' => $this->faker->randomNumber,
        ];
    }
}
