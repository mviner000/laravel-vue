<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'id' => '4b968f24-2b9d-4a9e-9c61-21fe9bf6cb20',
            'name' => 'Product 1',
            'description' => 'Description for Product 1',
        ]);
        
        Product::create([
            'id' => 'c8a8649e-4227-4db5-ba5f-d796426b40e4',
            'name' => 'Product 2',
            'description' => 'Description for Product 2',
        ]);
        
        Product::create([
            'id' => '3c3169a3-ae9d-45b5-815d-3c7a5e46e487',
            'name' => 'Product 3',
            'description' => 'Description for Product 3',
        ]);
        
        Product::create([
            'id' => '7fd6f77b-f8a6-4f7c-8f54-ff87177cb08a',
            'name' => 'Product 4',
            'description' => 'Description for Product 4',
        ]);
        
        Product::create([
            'id' => '72275595-7017-4b28-91cc-c70e22b7f636',
            'name' => 'Product 5',
            'description' => 'Description for Product 5',
        ]);
        
        Product::create([
            'id' => 'a41aa2d5-83c5-4e63-91c3-9f1414bfb3e3',
            'name' => 'Product 6',
            'description' => 'Description for Product 6',
        ]);
        
        Product::create([
            'id' => '30d00e4e-606e-45de-bd77-77ff0e70e333',
            'name' => 'Product 7',
            'description' => 'Description for Product 7',
        ]);
        
        Product::create([
            'id' => 'd7088934-f540-4b20-9b59-8103676dc34c',
            'name' => 'Product 8',
            'description' => 'Description for Product 8',
        ]);
        
        Product::create([
            'id' => 'cb743365-47a2-42b1-80f6-f0a0d6fe0276',
            'name' => 'Product 9',
            'description' => 'Description for Product 9',
        ]);
        
        Product::create([
            'id' => 'f6669b6b-4b44-4f2a-a660-5b3dc1918f49',
            'name' => 'Product 10',
            'description' => 'Description for Product 10',
        ]);

        Supplier::factory(10)->create();
        Transaction::factory(10)->create();
        Product::factory(10)->create();
        
    }
}
