<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'orders';
    public $fillable = [
        'user_id',
        'shop_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status',
    ];
}
