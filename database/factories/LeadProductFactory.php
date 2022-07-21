<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\LeadProduct;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomNumber,
            'price' => $this->faker->randomNumber(0),
            'amount' => $this->faker->randomNumber(2),
            'product_id' => Product::inRandomOrder()->first()->id,
            'lead_id' => Lead::inRandomorder()->first()->id,
        ];
    }
}
