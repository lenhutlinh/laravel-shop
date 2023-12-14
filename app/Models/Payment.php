<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'payment';
    public $fillable = [
        'payment_method',
        'payment_status',
    ];
}
