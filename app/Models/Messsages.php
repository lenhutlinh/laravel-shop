<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messsages extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'messages';
    public $fillable = [
        'user_id',
        'shop_id',
        'message',
        'sender',
        'status',
        'created_at'
    ];
}
