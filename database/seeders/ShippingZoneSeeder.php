<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingZone;

class ShippingZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingZones = [
            // Vùng nội thành (phí ship thấp)
            ['province_name' => 'Hà Nội', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 21.0285, 'longitude' => 105.8542],
            ['province_name' => 'TP. Hồ Chí Minh', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 10.8231, 'longitude' => 106.6297],
            ['province_name' => 'Đà Nẵng', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 16.0544, 'longitude' => 108.2022],
            ['province_name' => 'Hải Phòng', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 20.8449, 'longitude' => 106.6881],
            ['province_name' => 'Cần Thơ', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 10.0452, 'longitude' => 105.7469],

            // Vùng gần (phí ship trung bình)
            ['province_name' => 'Bắc Ninh', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Hưng Yên', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Hà Nam', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Thái Bình', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Nam Định', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Bình Dương', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Đồng Nai', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],
            ['province_name' => 'Long An', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2],

            // Vùng xa (phí ship cao hơn)
            ['province_name' => 'Quảng Ninh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Lào Cai', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Điện Biên', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Lai Châu', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Sơn La', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Yên Bái', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Hà Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Cao Bằng', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bắc Kạn', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Tuyên Quang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Phú Thọ', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Vĩnh Phúc', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bắc Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Lạng Sơn', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Thái Nguyên', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Hòa Bình', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Ninh Bình', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Thanh Hóa', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Nghệ An', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Hà Tĩnh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Quảng Bình', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Quảng Trị', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Thừa Thiên Huế', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Quảng Nam', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Quảng Ngãi', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bình Định', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Phú Yên', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Khánh Hòa', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Ninh Thuận', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bình Thuận', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bà Rịa - Vũng Tàu', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Tây Ninh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bình Phước', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'An Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Kiên Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Cà Mau', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bạc Liêu', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Sóc Trăng', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Trà Vinh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Vĩnh Long', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Đồng Tháp', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Tiền Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Bến Tre', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],
            ['province_name' => 'Hậu Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3],

            // Vùng rất xa (phí ship cao nhất)
            ['province_name' => 'Kon Tum', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5],
            ['province_name' => 'Gia Lai', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5],
            ['province_name' => 'Đắk Lắk', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5],
            ['province_name' => 'Đắk Nông', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5],
            ['province_name' => 'Lâm Đồng', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5],
        ];

        foreach ($shippingZones as $zone) {
            ShippingZone::create($zone);
        }
    }
}
