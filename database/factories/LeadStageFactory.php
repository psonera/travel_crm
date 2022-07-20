<?php

namespace Database\Factories;

use App\Models\LeadStage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadStageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadStage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name,
            'is_user_defined' => $this->faker->numberBetween(0, 127),
            'lead_pipeline_id' => \App\Models\LeadPipeline::factory(),
        ];
    }
}
