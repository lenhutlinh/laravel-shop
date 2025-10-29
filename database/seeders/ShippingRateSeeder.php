<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingRate;

class ShippingRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingRates = [
            [
                'min_distance' => 0,
                'max_distance' => 5,
                'shipping_cost' => 15000,
                'description' => 'Nội thành (0-5km)',
                'is_active' => true
            ],
            [
                'min_distance' => 5,
                'max_distance' => 20,
                'shipping_cost' => 20000,
                'description' => 'Ngoại thành (5-20km)',
                'is_active' => true
            ],
            [
                'min_distance' => 20,
                'max_distance' => 50,
                'shipping_cost' => 25000,
                'description' => 'Tỉnh lân cận (20-50km)',
                'is_active' => true
            ],
            [
                'min_distance' => 50,
                'max_distance' => 100,
                'shipping_cost' => 30000,
                'description' => 'Tỉnh xa (50-100km)',
                'is_active' => true
            ],
            [
                'min_distance' => 100,
                'max_distance' => 200,
                'shipping_cost' => 40000,
                'description' => 'Vùng miền (100-200km)',
                'is_active' => true
            ],
            [
                'min_distance' => 200,
                'max_distance' => 500,
                'shipping_cost' => 50000,
                'description' => 'Khác vùng miền (200-500km)',
                'is_active' => true
            ],
            [
                'min_distance' => 500,
                'max_distance' => null,
                'shipping_cost' => 60000,
                'description' => 'Rất xa (>500km)',
                'is_active' => true
            ]
        ];

        foreach ($shippingRates as $rate) {
            ShippingRate::create($rate);
        }
    }
}