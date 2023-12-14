<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Products extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products';
    public $fillable = [
        'shop_id',
        'category_id',
        'subcategory_id',
        'productName',
        'price',
        'description',
        'categoryName',
        'subCategoryName',
    ];
}
