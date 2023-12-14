<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsVariationsOptions extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products_variations_options';
    public $fillable = [
        'product_id',
        'variationName',
    ];
}
