<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    protected $table = 'shipping_zones';
    
    protected $fillable = [
        'province_name',
        'zone_type',
        'shipping_cost',
        'estimated_days',
        'is_active'
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Tìm phí ship theo tên tỉnh/thành phố
     */
    public static function getShippingCostByProvince($provinceName)
    {
        $zone = self::where('province_name', 'like', '%' . $provinceName . '%')
                    ->where('is_active', true)
                    ->first();
        
        return $zone ? $zone->shipping_cost : 30000; // Mặc định 30,000 nếu không tìm thấy
    }

    /**
     * Lấy thông tin vùng giao hàng theo tỉnh
     */
    public static function getZoneByProvince($provinceName)
    {
        return self::where('province_name', 'like', '%' . $provinceName . '%')
                   ->where('is_active', true)
                   ->first();
    }
}
