<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'order_detail';
    public $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_quantity',
        'product_price',
        'product_combination',
        'combination_id',
    ];
}
