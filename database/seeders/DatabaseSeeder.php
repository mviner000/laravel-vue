<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id' => 'f6abfaba-94a2-4943-96ab-5601d0d22519',
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'id' => 'e4d032a2-7aa6-4c1a-94ec-6117ef87037f',
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'id' => 'b1cabbf4-8c2f-4ff3-9e6f-fb024172e4f5',
            'name' => 'User 3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'id' => 'db7c7ff0-8be9-48af-b2a0-08e8b53b68d7',
            'name' => 'User 4',
            'email' => 'user4@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'id' => 'a9e4d164-7b82-4a4d-9612-3b848ad07235',
            'name' => 'User 5',
            'email' => 'user5@example.com',
            'password' => bcrypt('password'),
        ]);


        ProductCategory::factory(10)->create();

        Product::create([
            'id' => Str::random(5),
            'name' => 'Product 1',
            'description' => 'Description for Product 1',
        ]);

        Supplier::factory(10)->create();
        Transaction::factory(10)->create();
        Product::factory(10)->create();
        
    }
}
