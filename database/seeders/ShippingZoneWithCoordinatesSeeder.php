<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingZone;

class ShippingZoneWithCoordinatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ
        ShippingZone::truncate();

        $shippingZones = [
            // Vùng nội thành (phí ship thấp)
            ['province_name' => 'Hà Nội', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 21.0285, 'longitude' => 105.8542],
            ['province_name' => 'TP. Hồ Chí Minh', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 10.8231, 'longitude' => 106.6297],
            ['province_name' => 'Đà Nẵng', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 16.0544, 'longitude' => 108.2022],
            ['province_name' => 'Hải Phòng', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 20.8449, 'longitude' => 106.6881],
            ['province_name' => 'Cần Thơ', 'zone_type' => 'local', 'shipping_cost' => 15000, 'estimated_days' => 1, 'latitude' => 10.0452, 'longitude' => 105.7469],

            // Vùng gần (phí ship trung bình)
            ['province_name' => 'Bắc Ninh', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 21.1861, 'longitude' => 106.0763],
            ['province_name' => 'Hưng Yên', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 20.6464, 'longitude' => 106.0511],
            ['province_name' => 'Hà Nam', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 20.5411, 'longitude' => 105.9228],
            ['province_name' => 'Thái Bình', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 20.4461, 'longitude' => 106.3422],
            ['province_name' => 'Nam Định', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 20.4208, 'longitude' => 106.1683],
            ['province_name' => 'Bình Dương', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 11.3254, 'longitude' => 106.4774],
            ['province_name' => 'Đồng Nai', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 11.1204, 'longitude' => 107.1946],
            ['province_name' => 'Long An', 'zone_type' => 'nearby', 'shipping_cost' => 25000, 'estimated_days' => 2, 'latitude' => 10.6086, 'longitude' => 106.6714],

            // Vùng xa (phí ship cao hơn)
            ['province_name' => 'Quảng Ninh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.0064, 'longitude' => 107.2925],
            ['province_name' => 'Lào Cai', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 22.3381, 'longitude' => 103.8441],
            ['province_name' => 'Điện Biên', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.3867, 'longitude' => 103.0233],
            ['province_name' => 'Lai Châu', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 22.3964, 'longitude' => 103.4581],
            ['province_name' => 'Sơn La', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.3257, 'longitude' => 103.9167],
            ['province_name' => 'Yên Bái', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.7051, 'longitude' => 104.8692],
            ['province_name' => 'Hà Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 22.7667, 'longitude' => 104.9833],
            ['province_name' => 'Cao Bằng', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 22.6667, 'longitude' => 106.2500],
            ['province_name' => 'Bắc Kạn', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 22.1500, 'longitude' => 105.8333],
            ['province_name' => 'Tuyên Quang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.8167, 'longitude' => 105.2167],
            ['province_name' => 'Phú Thọ', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.3000, 'longitude' => 105.4167],
            ['province_name' => 'Vĩnh Phúc', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.3000, 'longitude' => 105.6000],
            ['province_name' => 'Bắc Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.2667, 'longitude' => 106.2000],
            ['province_name' => 'Lạng Sơn', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 22.0000, 'longitude' => 106.7500],
            ['province_name' => 'Thái Nguyên', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 21.6000, 'longitude' => 105.8500],
            ['province_name' => 'Hòa Bình', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 20.8167, 'longitude' => 105.3333],
            ['province_name' => 'Ninh Bình', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 20.2500, 'longitude' => 105.9667],
            ['province_name' => 'Thanh Hóa', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 19.8000, 'longitude' => 105.7667],
            ['province_name' => 'Nghệ An', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 18.6667, 'longitude' => 105.6667],
            ['province_name' => 'Hà Tĩnh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 18.3333, 'longitude' => 105.9000],
            ['province_name' => 'Quảng Bình', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 17.4667, 'longitude' => 106.6000],
            ['province_name' => 'Quảng Trị', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 16.7500, 'longitude' => 107.2000],
            ['province_name' => 'Thừa Thiên Huế', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 16.4667, 'longitude' => 107.5833],
            ['province_name' => 'Quảng Nam', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 15.5833, 'longitude' => 108.5000],
            ['province_name' => 'Quảng Ngãi', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 15.1167, 'longitude' => 108.8000],
            ['province_name' => 'Bình Định', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 13.7667, 'longitude' => 109.2333],
            ['province_name' => 'Phú Yên', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 13.0833, 'longitude' => 109.3167],
            ['province_name' => 'Khánh Hòa', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 12.2500, 'longitude' => 109.1833],
            ['province_name' => 'Ninh Thuận', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 11.5667, 'longitude' => 108.9833],
            ['province_name' => 'Bình Thuận', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.9333, 'longitude' => 108.1000],
            ['province_name' => 'Bà Rịa - Vũng Tàu', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.3500, 'longitude' => 107.0833],
            ['province_name' => 'Tây Ninh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 11.3167, 'longitude' => 106.1000],
            ['province_name' => 'Bình Phước', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 11.7500, 'longitude' => 106.6667],
            ['province_name' => 'An Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.5167, 'longitude' => 105.4167],
            ['province_name' => 'Kiên Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 9.9167, 'longitude' => 105.0833],
            ['province_name' => 'Cà Mau', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 9.1833, 'longitude' => 105.1500],
            ['province_name' => 'Bạc Liêu', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 9.2833, 'longitude' => 105.7167],
            ['province_name' => 'Sóc Trăng', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 9.6000, 'longitude' => 105.9833],
            ['province_name' => 'Trà Vinh', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 9.9333, 'longitude' => 106.3500],
            ['province_name' => 'Vĩnh Long', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.2500, 'longitude' => 105.9667],
            ['province_name' => 'Đồng Tháp', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.4500, 'longitude' => 105.6333],
            ['province_name' => 'Tiền Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.3667, 'longitude' => 106.3667],
            ['province_name' => 'Bến Tre', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 10.2333, 'longitude' => 106.3833],
            ['province_name' => 'Hậu Giang', 'zone_type' => 'far', 'shipping_cost' => 35000, 'estimated_days' => 3, 'latitude' => 9.7833, 'longitude' => 105.4667],

            // Vùng rất xa (phí ship cao nhất)
            ['province_name' => 'Kon Tum', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5, 'latitude' => 14.3500, 'longitude' => 108.0000],
            ['province_name' => 'Gia Lai', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5, 'latitude' => 13.9833, 'longitude' => 108.0000],
            ['province_name' => 'Đắk Lắk', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5, 'latitude' => 12.6667, 'longitude' => 108.0500],
            ['province_name' => 'Đắk Nông', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5, 'latitude' => 12.0000, 'longitude' => 107.7000],
            ['province_name' => 'Lâm Đồng', 'zone_type' => 'remote', 'shipping_cost' => 50000, 'estimated_days' => 5, 'latitude' => 11.9333, 'longitude' => 108.4500],
        ];

        foreach ($shippingZones as $zone) {
            ShippingZone::create($zone);
        }
    }
}
