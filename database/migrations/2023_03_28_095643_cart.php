<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('shop_id')->constrained('shop');
            $table->foreignId('product_id')->constrained('products');
            $table->string('productName');
            $table->string('quantity');
            $table->string('product_price');
            $table->string('combination')->nullable();
            $table->string('product_image');
            $table->string('avaialbe_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
