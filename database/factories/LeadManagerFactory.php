<?php

namespace Database\Factories;

use App\Models\LeadManager;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadManager::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->text,
            'contact_number' => $this->faker->text,
            'lead_source_id' => \App\Models\LeadSource::factory(),
        ];
    }
}
