<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateCoupon extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'is_active',
        'shop_id',
        'created_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2'
    ];

    /**
     * Relationship với Shop
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Relationship với User (người tạo)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Kiểm tra mã giảm giá có hợp lệ không
     */
    public function isValid(): bool
    {
        $now = now();
        
        return $this->is_active 
            && $this->start_date <= $now->toDateString()
            && $this->end_date >= $now->toDateString()
            && ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    /**
     * Tính toán giá trị giảm giá
     */
    public function calculateDiscount(float $orderAmount): float
    {
        if (!$this->isValid()) {
            return 0;
        }

        // Kiểm tra đơn hàng tối thiểu
        if ($this->minimum_amount && $orderAmount < $this->minimum_amount) {
            return 0;
        }

        $discount = 0;
        
        if ($this->type === 'percentage') {
            $discount = ($orderAmount * $this->value) / 100;
        } else {
            $discount = $this->value;
        }

        // Áp dụng giảm tối đa
        if ($this->maximum_discount && $discount > $this->maximum_discount) {
            $discount = $this->maximum_discount;
        }

        // Không được giảm quá tổng đơn hàng
        return min($discount, $orderAmount);
    }

    /**
     * Tăng số lần sử dụng
     */
    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }
}
