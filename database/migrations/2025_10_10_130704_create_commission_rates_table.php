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
        Schema::create('commission_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shop')->onDelete('cascade');
            $table->decimal('rate', 5, 2)->default(4.00); // Tỷ lệ hoa hồng (4.00%)
            $table->decimal('total_commission', 15, 2)->default(0.00); // Tổng hoa hồng đã tích lũy
            $table->decimal('pending_commission', 15, 2)->default(0.00); // Hoa hồng chưa thanh toán
            $table->decimal('paid_commission', 15, 2)->default(0.00); // Hoa hồng đã thanh toán
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('commission_rates');
    }
};