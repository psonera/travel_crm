<?php

namespace Database\Factories;

use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'billing_address' => $this->faker->text,
            'shipping_address' => $this->faker->text,
            'discount_percent' => $this->faker->randomNumber(0),
            'discount_amount' => $this->faker->randomNumber(0),
            'tax_amount' => $this->faker->randomNumber(0),
            'adjustment_amount' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(0),
            'grand_total' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
            'lead_manager_id' => \App\Models\LeadManager::factory(),
        ];
    }
}
