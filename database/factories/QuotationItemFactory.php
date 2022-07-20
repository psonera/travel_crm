<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\QuotationItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuotationItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->text(255),
            'name' => $this->faker->name,
            'quantity' => $this->faker->randomNumber(0),
            'price' => $this->faker->randomNumber(0),
            'coupon_code' => $this->faker->text(255),
            'discount_percent' => $this->faker->randomNumber(2),
            'discount_amount' => $this->faker->randomNumber(2),
            'tax_percent' => $this->faker->randomNumber(2),
            'tax_amount' => $this->faker->randomNumber(2),
            'total' => $this->faker->randomFloat(2, 0, 99),
            'product_id' => $this->faker->randomNumber,
            'quotation_id' => \App\Models\Quotation::factory(),
        ];
    }
}
