<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Users extends Model
{
    use HasFactory;
    public $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role_id',
        'status',
        'userImg',
    ];
    public $timestamps = true;
    protected $table = 'users';
   
}
