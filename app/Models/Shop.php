<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Shop extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'shop';
    
    public $fillable = [
        'shopname',
        'email',
        'password',
        'role_id',
        'status',
        'shopImg',
        'address',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    /**
     * Relationship với CommissionRate
     */
    public function commissionRate()
    {
        return $this->hasOne(CommissionRate::class);
    }

    /**
     * Relationship với Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
