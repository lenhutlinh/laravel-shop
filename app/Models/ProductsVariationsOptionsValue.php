<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsVariationsOptionsValue extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products_variations_options_value';
    public $fillable = [
        'products_variation_id',
        'variationName',
    ];
}
