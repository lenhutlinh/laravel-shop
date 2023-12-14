<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class SubCategories extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'subcategories';
    public $fillable = [
        'category_id',
        'subCategoryName',
    ];
}
