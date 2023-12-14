<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCombination extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products_combinations';
    public $fillable = [
        'product_id',
        'combanition_string',
        'avaiable_stock',
    ];
}
