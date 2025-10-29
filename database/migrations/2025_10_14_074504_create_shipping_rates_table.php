<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_distance', 8, 2)->default(0); // Khoảng cách tối thiểu (km)
            $table->decimal('max_distance', 8, 2)->nullable(); // Khoảng cách tối đa (km), null = không giới hạn
            $table->decimal('shipping_cost', 10, 2); // Phí ship (VND)
            $table->string('description')->nullable(); // Mô tả
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->timestamps();
            
            $table->index(['min_distance', 'max_distance']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};