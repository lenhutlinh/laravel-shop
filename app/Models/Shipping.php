<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'shipping';
    public $fillable = [
        'order_id',
        'user_id',
        'shop_id',
        'ship_name',
        'ship_phonenumber',
        'ship_address',
        'ship_email',
        'note',
        'total_price',
        'ship_status', 
    ];

}
