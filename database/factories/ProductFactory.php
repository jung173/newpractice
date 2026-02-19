<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'product_name' => $this->faker->word,
            'price' => 1000,
            'stock' => 10,
            'comment' => $this->faker->sentence,
            'company_id' => Company::factory(),
        ];
    }
}