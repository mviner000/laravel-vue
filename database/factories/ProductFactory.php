<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'grocery_price' => $this->faker->randomFloat(2, 0, 1000),
            'selling_price' => $this->faker->randomFloat(2, 0, 1000),
            'barcode' => $this->faker->unique()->ean13,
            'quantity' => $this->faker->numberBetween(0, 100),
            'cabinet' => $this->faker->word,
            'category_id' => ProductCategory::pluck('id')->random(),
            'supplier_id' => Supplier::pluck('id')->random(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
