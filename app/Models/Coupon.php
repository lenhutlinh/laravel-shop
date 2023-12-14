<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'coupon';
    public $fillable = [
        'coupon_code',
        'coupon_name',
        'coupon_type',
        'coupon_condition',
        'coupon_value',
        'coupon_amount'
    ];
}
