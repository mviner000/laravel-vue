<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCartTable extends Migration
{
    public function up()
    {
        Schema::create('product_carts', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Change to UUID
          
            $table->integer('quantity')->default(1); // You might want to customize this according to your requirements
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_carts');
    }
}
