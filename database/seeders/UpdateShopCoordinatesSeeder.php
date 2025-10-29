<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class UpdateShopCoordinatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tọa độ các thành phố chính (có thể phân bổ shop theo vùng)
        $cityCoordinates = [
            'Hà Nội' => ['lat' => 21.0285, 'lng' => 105.8542],
            'TP. Hồ Chí Minh' => ['lat' => 10.8231, 'lng' => 106.6297],
            'Đà Nẵng' => ['lat' => 16.0544, 'lng' => 108.2022],
            'Hải Phòng' => ['lat' => 20.8449, 'lng' => 106.6881],
            'Cần Thơ' => ['lat' => 10.0452, 'lng' => 105.7469],
            'Bắc Ninh' => ['lat' => 21.1861, 'lng' => 106.0763],
            'Hưng Yên' => ['lat' => 20.6464, 'lng' => 106.0511],
            'Bình Dương' => ['lat' => 11.3254, 'lng' => 106.4774],
            'Đồng Nai' => ['lat' => 11.1204, 'lng' => 107.1946],
            'Long An' => ['lat' => 10.6086, 'lng' => 106.6714],
        ];

        // Lấy tất cả shop chưa có tọa độ
        $shops = Shop::whereNull('latitude')->orWhereNull('longitude')->get();
        
        echo "Tìm thấy " . $shops->count() . " shop cần cập nhật tọa độ\n";

        foreach ($shops as $index => $shop) {
            // Phân bổ shop theo vùng (có thể random hoặc theo logic khác)
            $cities = array_keys($cityCoordinates);
            $selectedCity = $cities[$index % count($cities)]; // Phân bổ đều
            $coordinates = $cityCoordinates[$selectedCity];

            // Cập nhật tọa độ cho shop
            $shop->update([
                'latitude' => $coordinates['lat'],
                'longitude' => $coordinates['lng']
            ]);

            echo "Shop ID {$shop->id} ({$shop->shopname}) -> {$selectedCity} ({$coordinates['lat']}, {$coordinates['lng']})\n";
        }

        // Cập nhật tất cả shop còn lại (nếu có) với tọa độ mặc định
        $remainingShops = Shop::whereNull('latitude')->orWhereNull('longitude')->get();
        if ($remainingShops->count() > 0) {
            echo "Cập nhật " . $remainingShops->count() . " shop còn lại với tọa độ mặc định (Hà Nội)\n";
            
            Shop::whereNull('latitude')->orWhereNull('longitude')->update([
                'latitude' => 21.0285, // Hà Nội
                'longitude' => 105.8542
            ]);
        }

        echo "Hoàn thành cập nhật tọa độ cho tất cả shop!\n";
    }
}
