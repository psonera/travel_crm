<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'to' => $this->faker->email(), 
            'from' => $this->faker->email(), 
            'cc' => $this->faker->email(), 
            'bcc' => $this->faker->email(),
            'subject' => $this->faker->text(15), 
            'content' => $this->faker->text(50),
            'status' => $this->faker->numberBetween(1, 5),
        ];
    }
}
