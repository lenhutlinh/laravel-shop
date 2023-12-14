<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class ProductsImages extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products_images';
    public $fillable = [
        'product_id',
        'imageProduct',
    ];
}
