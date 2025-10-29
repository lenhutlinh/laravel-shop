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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shop');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subcategory_id')->constrained('subcategories');
            $table->string('productName');
            $table->float('price');
            $table->string('description');
            $table->string('categoryName');
            $table->string('subCategoryName');
            $table->string('previewImage')->nullable();
            $table->integer('status')->default(1);
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
