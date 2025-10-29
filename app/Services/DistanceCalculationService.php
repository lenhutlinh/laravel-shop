<?php

namespace App\Services;

class DistanceCalculationService
{
    /**
     * Tính khoảng cách giữa 2 điểm bằng công thức Haversine (km)
     */
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Bán kính Trái Đất (km)
        $earthRadius = 6371;

        // Chuyển đổi độ sang radian
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        // Tính hiệu số
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;

        // Công thức Haversine
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1Rad) * cos($lat2Rad) *
             sin($deltaLon / 2) * sin($deltaLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return round($distance, 2);
    }

    /**
     * Tính phí ship dựa trên khoảng cách
     */
    public static function calculateShippingCostByDistance($distance)
    {
        if ($distance <= 10) {
            // Nội thành: 0-10km
            return 15000;
        } elseif ($distance <= 50) {
            // Vùng gần: 10-50km
            return 25000;
        } elseif ($distance <= 200) {
            // Vùng xa: 50-200km
            return 35000;
        } else {
            // Vùng rất xa: >200km
            return 50000;
        }
    }

    /**
     * Tính phí ship dựa trên khoảng cách với công thức linh hoạt hơn
     */
    public static function calculateShippingCostByDistanceAdvanced($distance)
    {
        // Phí cơ bản
        $baseCost = 15000;
        
        // Phí theo km (tăng dần)
        $costPerKm = 200; // 200 VND/km
        
        // Tính phí
        $totalCost = $baseCost + ($distance * $costPerKm);
        
        // Giới hạn tối đa và tối thiểu
        $minCost = 15000;
        $maxCost = 80000;
        
        return max($minCost, min($maxCost, $totalCost));
    }

    /**
     * Lấy tọa độ của tỉnh/thành phố từ địa chỉ
     */
    public static function getCoordinatesFromAddress($address)
    {
        // Danh sách tọa độ các tỉnh/thành phố chính
        $coordinates = [
            'Hà Nội' => ['lat' => 21.0285, 'lng' => 105.8542],
            'TP. Hồ Chí Minh' => ['lat' => 10.8231, 'lng' => 106.6297],
            'Đà Nẵng' => ['lat' => 16.0544, 'lng' => 108.2022],
            'Hải Phòng' => ['lat' => 20.8449, 'lng' => 106.6881],
            'Cần Thơ' => ['lat' => 10.0452, 'lng' => 105.7469],
            'Bắc Ninh' => ['lat' => 21.1861, 'lng' => 106.0763],
            'Hưng Yên' => ['lat' => 20.6464, 'lng' => 106.0511],
            'Hà Nam' => ['lat' => 20.5411, 'lng' => 105.9228],
            'Thái Bình' => ['lat' => 20.4461, 'lng' => 106.3422],
            'Nam Định' => ['lat' => 20.4208, 'lng' => 106.1683],
            'Bình Dương' => ['lat' => 11.3254, 'lng' => 106.4774],
            'Đồng Nai' => ['lat' => 11.1204, 'lng' => 107.1946],
            'Long An' => ['lat' => 10.6086, 'lng' => 106.6714],
            'Quảng Ninh' => ['lat' => 21.0064, 'lng' => 107.2925],
            'Lào Cai' => ['lat' => 22.3381, 'lng' => 103.8441],
            'Điện Biên' => ['lat' => 21.3867, 'lng' => 103.0233],
            'Lai Châu' => ['lat' => 22.3964, 'lng' => 103.4581],
            'Sơn La' => ['lat' => 21.3257, 'lng' => 103.9167],
            'Yên Bái' => ['lat' => 21.7051, 'lng' => 104.8692],
            'Hà Giang' => ['lat' => 22.7667, 'lng' => 104.9833],
            'Cao Bằng' => ['lat' => 22.6667, 'lng' => 106.2500],
            'Bắc Kạn' => ['lat' => 22.1500, 'lng' => 105.8333],
            'Tuyên Quang' => ['lat' => 21.8167, 'lng' => 105.2167],
            'Phú Thọ' => ['lat' => 21.3000, 'lng' => 105.4167],
            'Vĩnh Phúc' => ['lat' => 21.3000, 'lng' => 105.6000],
            'Bắc Giang' => ['lat' => 21.2667, 'lng' => 106.2000],
            'Lạng Sơn' => ['lat' => 22.0000, 'lng' => 106.7500],
            'Thái Nguyên' => ['lat' => 21.6000, 'lng' => 105.8500],
            'Hòa Bình' => ['lat' => 20.8167, 'lng' => 105.3333],
            'Ninh Bình' => ['lat' => 20.2500, 'lng' => 105.9667],
            'Thanh Hóa' => ['lat' => 19.8000, 'lng' => 105.7667],
            'Nghệ An' => ['lat' => 18.6667, 'lng' => 105.6667],
            'Hà Tĩnh' => ['lat' => 18.3333, 'lng' => 105.9000],
            'Quảng Bình' => ['lat' => 17.4667, 'lng' => 106.6000],
            'Quảng Trị' => ['lat' => 16.7500, 'lng' => 107.2000],
            'Thừa Thiên Huế' => ['lat' => 16.4667, 'lng' => 107.5833],
            'Quảng Nam' => ['lat' => 15.5833, 'lng' => 108.5000],
            'Quảng Ngãi' => ['lat' => 15.1167, 'lng' => 108.8000],
            'Bình Định' => ['lat' => 13.7667, 'lng' => 109.2333],
            'Phú Yên' => ['lat' => 13.0833, 'lng' => 109.3167],
            'Khánh Hòa' => ['lat' => 12.2500, 'lng' => 109.1833],
            'Ninh Thuận' => ['lat' => 11.5667, 'lng' => 108.9833],
            'Bình Thuận' => ['lat' => 10.9333, 'lng' => 108.1000],
            'Bà Rịa - Vũng Tàu' => ['lat' => 10.3500, 'lng' => 107.0833],
            'Tây Ninh' => ['lat' => 11.3167, 'lng' => 106.1000],
            'Bình Phước' => ['lat' => 11.7500, 'lng' => 106.6667],
            'An Giang' => ['lat' => 10.5167, 'lng' => 105.4167],
            'Kiên Giang' => ['lat' => 9.9167, 'lng' => 105.0833],
            'Cà Mau' => ['lat' => 9.1833, 'lng' => 105.1500],
            'Bạc Liêu' => ['lat' => 9.2833, 'lng' => 105.7167],
            'Sóc Trăng' => ['lat' => 9.6000, 'lng' => 105.9833],
            'Trà Vinh' => ['lat' => 9.9333, 'lng' => 106.3500],
            'Vĩnh Long' => ['lat' => 10.2500, 'lng' => 105.9667],
            'Đồng Tháp' => ['lat' => 10.4500, 'lng' => 105.6333],
            'Tiền Giang' => ['lat' => 10.3667, 'lng' => 106.3667],
            'Bến Tre' => ['lat' => 10.2333, 'lng' => 106.3833],
            'Hậu Giang' => ['lat' => 9.7833, 'lng' => 105.4667],
            'Kon Tum' => ['lat' => 14.3500, 'lng' => 108.0000],
            'Gia Lai' => ['lat' => 13.9833, 'lng' => 108.0000],
            'Đắk Lắk' => ['lat' => 12.6667, 'lng' => 108.0500],
            'Đắk Nông' => ['lat' => 12.0000, 'lng' => 107.7000],
            'Lâm Đồng' => ['lat' => 11.9333, 'lng' => 108.4500],
        ];

        // Tìm tỉnh trong địa chỉ
        foreach ($coordinates as $province => $coords) {
            if (stripos($address, $province) !== false) {
                return $coords;
            }
        }

        return null;
    }
}
