<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lead::class;

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
            'lead_value' => $this->faker->randomNumber(0),
            'status' => $this->faker->numberBetween(0, 127),
            'lost_reason' => $this->faker->text,
            'traveler_count' => $this->faker->randomNumber(0),
            'selected_trip_date' => $this->faker->date,
            'closed_at' => $this->faker->dateTime,
            'expected_closed_date' => $this->faker->date,
            'user_id' => \App\Models\User::factory(),
            'lead_manager_id' => \App\Models\LeadManager::factory(),
            'lead_type_id' => rand(1,2),
            'lead_source_id' => rand(1,4),
            'lead_pipeline_id' => \App\Models\LeadPipeline::factory(),
            'lead_pipeline_stage_id' => rand(1,6),
            'trip_id' => \App\Models\Trip::factory(),
            'trip_type_id' => \App\Models\TripType::factory(),
            'accomodation_id' => \App\Models\Accomodation::factory(),
            'transport_id' => \App\Models\Transport::factory(),
        ];
    }
}
