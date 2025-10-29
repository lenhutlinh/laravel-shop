<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_distance',
        'max_distance',
        'shipping_cost',
        'description',
        'is_active'
    ];

    protected $casts = [
        'min_distance' => 'decimal:2',
        'max_distance' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Tìm phí ship phù hợp dựa trên khoảng cách
     */
    public static function findRateByDistance($distance)
    {
        return self::where('is_active', true)
            ->where('min_distance', '<=', $distance)
            ->where(function($query) use ($distance) {
                $query->whereNull('max_distance')
                      ->orWhere('max_distance', '>=', $distance);
            })
            ->orderBy('min_distance', 'asc')
            ->first();
    }

    /**
     * Lấy tất cả phí ship đang hoạt động
     */
    public static function getActiveRates()
    {
        return self::where('is_active', true)
            ->orderBy('min_distance', 'asc')
            ->get();
    }
}