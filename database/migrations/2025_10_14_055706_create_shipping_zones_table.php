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
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->id();
            $table->string('province_name'); // Tên tỉnh/thành phố
            $table->string('zone_type'); // Loại vùng: 'local', 'nearby', 'far', 'remote'
            $table->decimal('shipping_cost', 10, 2); // Phí ship
            $table->integer('estimated_days'); // Số ngày giao hàng dự kiến
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_zones');
    }
};
