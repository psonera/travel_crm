<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->unique->text(255),
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(15),
            'quantity' => $this->faker->randomNumber,
            'price' => $this->faker->randomNumber(0),
        ];
    }
}
