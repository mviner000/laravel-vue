<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'product_id' => Product::pluck('id')->random(),
            'customer_name' => $this->faker->name,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
