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
        Schema::create('private_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã giảm giá riêng
            $table->string('name'); // Tên mã giảm giá
            $table->text('description')->nullable(); // Mô tả
            $table->enum('type', ['percentage', 'fixed']); // Loại: phần trăm hoặc số tiền cố định
            $table->decimal('value', 10, 2); // Giá trị giảm giá
            $table->decimal('minimum_amount', 10, 2)->nullable(); // Đơn hàng tối thiểu
            $table->decimal('maximum_discount', 10, 2)->nullable(); // Giảm tối đa
            $table->integer('usage_limit')->nullable(); // Giới hạn sử dụng
            $table->integer('used_count')->default(0); // Số lần đã sử dụng
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date'); // Ngày kết thúc
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->unsignedBigInteger('shop_id')->nullable(); // ID cửa hàng (null = áp dụng cho tất cả)
            $table->unsignedBigInteger('created_by'); // Người tạo (admin)
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('shop_id')->references('id')->on('shop')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            
            // Indexes
            $table->index(['code', 'is_active']);
            $table->index(['shop_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_coupons');
    }
};
