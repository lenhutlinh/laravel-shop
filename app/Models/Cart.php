<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'cart';
    public $fillable = [
        'user_id',
        'product_id',
        'productName',
        'quantity',
        'product_price',
        'product_image',
        'combination',
        'available_stock',
        'combination_id',
    ];
}
