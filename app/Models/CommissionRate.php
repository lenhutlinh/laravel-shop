<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionRate extends Model
{
    use HasFactory;

    protected $table = 'commission_rates';
    
    protected $fillable = [
        'shop_id',
        'rate',
        'total_commission',
        'pending_commission',
        'paid_commission',
        'status'
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'total_commission' => 'decimal:2',
        'pending_commission' => 'decimal:2',
        'paid_commission' => 'decimal:2',
    ];

    /**
     * Relationship với Shop
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Tính hoa hồng cho một đơn hàng
     */
    public function calculateCommission($orderTotal)
    {
        return ($orderTotal * $this->rate) / 100;
    }

    /**
     * Cập nhật hoa hồng khi có đơn hàng mới (đã thu ngay)
     */
    public function addCommission($amount)
    {
        $this->total_commission += $amount;
        $this->paid_commission += $amount; // Admin đã thu ngay khi đơn hàng hoàn thành
        $this->save();
    }

    /**
     * Thêm hoa hồng vào trạng thái đang xử lý
     */
    public function addPendingCommission($amount)
    {
        $this->total_commission += $amount;
        $this->pending_commission += $amount;
        $this->save();
    }

    /**
     * Chuyển hoa hồng từ đang xử lý sang đã thu
     */
    public function completeCommission($amount)
    {
        if ($this->pending_commission >= $amount) {
            $this->pending_commission -= $amount;
            $this->paid_commission += $amount;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Chuyển hoa hồng từ đã thu về đang xử lý (khi đơn hàng bị hủy)
     */
    public function revertCommission($amount)
    {
        if ($amount <= $this->paid_commission) {
            $this->paid_commission -= $amount;
            $this->pending_commission += $amount; // Chuyển về đang xử lý
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Thanh toán hoa hồng (chuyển từ đang xử lý sang đã thu)
     */
    public function refundCommission($amount)
    {
        if ($amount <= $this->pending_commission) {
            $this->pending_commission -= $amount;
            $this->paid_commission += $amount; // Chuyển thành đã thu
            $this->save();
            return true;
        }
        return false;
    }
}