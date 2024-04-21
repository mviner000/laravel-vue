<?php

namespace Database\Factories;

use App\Models\ProductCart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCartFactory extends Factory
{
    protected $model = ProductCart::class;

    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'product_id' => Product::pluck('id')->random(),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
