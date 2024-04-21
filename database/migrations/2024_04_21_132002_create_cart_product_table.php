<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->uuid('cart_id');
            $table->foreign('cart_id')->references('id')->on('product_carts')->onDelete('cascade');
            
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('quantity')->default(1); // Quantity of this product in the cart
            
            $table->primary(['cart_id', 'product_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
}
