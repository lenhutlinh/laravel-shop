<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Categories extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'categories';
    public $fillable = [
        'categoryName',
        'categoryIcon',
        'description',
    ];
}
