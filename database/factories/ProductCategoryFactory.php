<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'created_by' => null, // You may customize this as needed
            'updated_by' => null, // You may customize this as needed
        ];
    }
}
