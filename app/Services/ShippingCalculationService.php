<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ShippingCalculationService
{
    /**
     * Tính phí ship dựa trên khoảng cách thực tế giữa shop và khách hàng
     * 
     * @param int $shopId ID của shop
     * @param string $address Địa chỉ giao hàng
     * @param float $latitude Tọa độ vĩ độ của khách hàng
     * @param float $longitude Tọa độ kinh độ của khách hàng
     * @return array Thông tin phí ship
     */
    public function getShippingInfo($shopId, $address, $latitude, $longitude)
    {
        // Lấy thông tin shop
        $shop = DB::table('shop')
            ->where('id', $shopId)
            ->select('latitude', 'longitude', 'address')
            ->first();
        
        // Nếu shop chưa đăng ký vị trí, sử dụng phí mặc định
        if (!$shop || !$shop->latitude || !$shop->longitude) {
            return [
                'shipping_cost' => 30000,
                'distance' => 0,
                'message' => 'Shop chưa đăng ký vị trí, sử dụng phí ship mặc định',
                'formatted_cost' => '30.000đ'
            ];
        }
        
        // Tính khoảng cách thực tế
        $distance = $this->calculateDistance(
            $shop->latitude, 
            $shop->longitude, 
            $latitude, 
            $longitude
        );
        
        // Tính phí ship theo bảng giá mới
        $shippingCost = $this->calculateShippingCostByDistance($distance);
        
        return [
            'shipping_cost' => $shippingCost,
            'distance' => round($distance, 2),
            'message' => "Khoảng cách: " . round($distance, 2) . "km",
            'formatted_cost' => number_format($shippingCost, 0, ',', '.') . 'đ'
        ];
    }
    
    /**
     * Tính phí ship dựa trên khoảng cách (fallback method)
     * 
     * @param string $address Địa chỉ giao hàng
     * @return int Phí ship (VND)
     */
    public function calculateShippingByDistance($address)
    {
        // Tính khoảng cách giả định dựa trên địa chỉ
        $distance = $this->estimateDistanceFromAddress($address);
        
        // Áp dụng bảng giá theo yêu cầu
        return $this->calculateShippingCostByDistance($distance);
    }
    
    /**
     * Tính phí ship theo khoảng cách
     * 
     * @param float $distance Khoảng cách (km)
     * @return int Phí ship (VND)
     */
    private function calculateShippingCostByDistance($distance)
    {
        if ($distance <= 5) {
            return 15000;
        } elseif ($distance <= 20) {
            return 20000;
        } elseif ($distance <= 50) {
            return 25000;
        } elseif ($distance <= 100) {
            return 30000;
        } elseif ($distance <= 200) {
            return 40000;
        } elseif ($distance <= 500) {
            return 50000;
        } else {
            return 60000;
        }
    }
    
    /**
     * Tính khoảng cách giữa 2 điểm bằng công thức Haversine (km)
     */
    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
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
     * Ước tính khoảng cách dựa trên địa chỉ (fallback method)
     * 
     * @param string $address
     * @return int Khoảng cách (km)
     */
    private function estimateDistanceFromAddress($address)
    {
        $address = strtolower($address);
        
        // Nội thành (gần)
        if (strpos($address, 'hà nội') !== false || 
            strpos($address, 'tp. hồ chí minh') !== false ||
            strpos($address, 'tp hcm') !== false ||
            strpos($address, 'ho chi minh') !== false) {
            return 3;
        }
        
        // Gần (tỉnh lân cận)
        if (strpos($address, 'cần thơ') !== false || 
            strpos($address, 'vĩnh long') !== false ||
            strpos($address, 'đồng tháp') !== false ||
            strpos($address, 'an giang') !== false) {
            return 8;
        }
        
        // Trung bình (miền Trung)
        if (strpos($address, 'đà nẵng') !== false || 
            strpos($address, 'hải phòng') !== false ||
            strpos($address, 'huế') !== false ||
            strpos($address, 'quảng nam') !== false) {
            return 150;
        }
        
        // Xa (miền Bắc xa)
        if (strpos($address, 'nghệ an') !== false || 
            strpos($address, 'thanh hóa') !== false ||
            strpos($address, 'hà tĩnh') !== false ||
            strpos($address, 'quảng bình') !== false) {
            return 300;
        }
        
        // Rất xa (miền núi, biên giới)
        if (strpos($address, 'lào cai') !== false || 
            strpos($address, 'điện biên') !== false ||
            strpos($address, 'cao bằng') !== false ||
            strpos($address, 'hà giang') !== false ||
            strpos($address, 'cà mau') !== false ||
            strpos($address, 'kiên giang') !== false) {
            return 600;
        }
        
        // Mặc định cho các tỉnh khác
        return 200;
    }
    
    /**
     * Tính phí ship cho nhiều đơn hàng
     * 
     * @param array $addresses Mảng địa chỉ
     * @return array Mảng phí ship tương ứng
     */
    public function calculateShippingForMultipleOrders($addresses)
    {
        $shippingCosts = [];
        
        foreach ($addresses as $address) {
            $shippingCosts[] = $this->calculateShippingByDistance($address);
        }
        
        return $shippingCosts;
    }
    
    /**
     * Lấy tọa độ từ địa chỉ (public method)
     * 
     * @param string $address Địa chỉ
     * @return array|null Tọa độ [lat, lng] hoặc null
     */
    public function getCoordinatesFromAddress($address)
    {
        $address = strtolower($address);
        
        // Database tọa độ cho các tỉnh/thành phố chính
        $coordinatesDB = [
            'hà nội' => ['lat' => 21.0285, 'lng' => 105.8542],
            'tp. hồ chí minh' => ['lat' => 10.8231, 'lng' => 106.6297],
            'tp hcm' => ['lat' => 10.8231, 'lng' => 106.6297],
            'ho chi minh' => ['lat' => 10.8231, 'lng' => 106.6297],
            'cần thơ' => ['lat' => 10.0452, 'lng' => 105.7469],
            'vĩnh long' => ['lat' => 10.2401, 'lng' => 105.9572],
            'đà nẵng' => ['lat' => 16.0544, 'lng' => 108.2022],
            'hải phòng' => ['lat' => 20.8449, 'lng' => 106.6881],
            'hà giang' => ['lat' => 22.7662, 'lng' => 104.9380],
            'cao bằng' => ['lat' => 22.6657, 'lng' => 106.2577],
            'lào cai' => ['lat' => 22.3381, 'lng' => 103.8440],
            'điện biên' => ['lat' => 21.3862, 'lng' => 103.0230],
            'lai châu' => ['lat' => 22.3687, 'lng' => 103.4400],
            'sơn la' => ['lat' => 21.3257, 'lng' => 103.9178],
            'yên bái' => ['lat' => 21.7168, 'lng' => 104.8986],
            'hoà bình' => ['lat' => 20.8136, 'lng' => 105.3382],
            'thái nguyên' => ['lat' => 21.5672, 'lng' => 105.8252],
            'lạng sơn' => ['lat' => 21.8537, 'lng' => 106.7613],
            'quảng ninh' => ['lat' => 21.0064, 'lng' => 107.2925],
            'bắc giang' => ['lat' => 21.2733, 'lng' => 106.1946],
            'phú thọ' => ['lat' => 21.3614, 'lng' => 105.3131],
            'vĩnh phúc' => ['lat' => 21.3609, 'lng' => 105.5474],
            'bắc ninh' => ['lat' => 21.1861, 'lng' => 106.0763],
            'hải dương' => ['lat' => 20.9373, 'lng' => 106.3146],
            'hưng yên' => ['lat' => 20.6534, 'lng' => 106.0513],
            'thái bình' => ['lat' => 20.4465, 'lng' => 106.3421],
            'hà nam' => ['lat' => 20.5411, 'lng' => 105.9229],
            'nam định' => ['lat' => 20.4388, 'lng' => 106.1621],
            'ninh bình' => ['lat' => 20.2506, 'lng' => 105.9744],
            'thanh hóa' => ['lat' => 19.8077, 'lng' => 105.7842],
            'nghệ an' => ['lat' => 18.6792, 'lng' => 105.6882],
            'hà tĩnh' => ['lat' => 18.3428, 'lng' => 105.9059],
            'quảng bình' => ['lat' => 17.4683, 'lng' => 106.6000],
            'quảng trị' => ['lat' => 16.7500, 'lng' => 107.2000],
            'thừa thiên huế' => ['lat' => 16.4637, 'lng' => 107.5909],
            'quảng nam' => ['lat' => 15.8801, 'lng' => 108.3380],
            'quảng ngãi' => ['lat' => 15.1167, 'lng' => 108.8000],
            'bình định' => ['lat' => 13.8750, 'lng' => 109.1119],
            'phú yên' => ['lat' => 13.0882, 'lng' => 109.0929],
            'khánh hòa' => ['lat' => 12.2388, 'lng' => 109.1967],
            'ninh thuận' => ['lat' => 11.5648, 'lng' => 108.9881],
            'bình thuận' => ['lat' => 10.9289, 'lng' => 108.1021],
            'kon tum' => ['lat' => 14.3545, 'lng' => 108.0076],
            'gia lai' => ['lat' => 13.9838, 'lng' => 108.0006],
            'đắk lắk' => ['lat' => 12.6667, 'lng' => 108.0500],
            'đắk nông' => ['lat' => 12.0042, 'lng' => 107.6907],
            'lâm đồng' => ['lat' => 11.9404, 'lng' => 108.4583],
            'bình phước' => ['lat' => 11.6471, 'lng' => 106.6056],
            'tây ninh' => ['lat' => 11.3131, 'lng' => 106.1093],
            'bình dương' => ['lat' => 11.3254, 'lng' => 106.4774],
            'đồng nai' => ['lat' => 10.9574, 'lng' => 106.8429],
            'bà rịa - vũng tàu' => ['lat' => 10.3460, 'lng' => 107.0843],
            'long an' => ['lat' => 10.6086, 'lng' => 106.6714],
            'tiền giang' => ['lat' => 10.3600, 'lng' => 106.3600],
            'bến tre' => ['lat' => 10.2404, 'lng' => 106.3756],
            'trà vinh' => ['lat' => 9.9347, 'lng' => 106.3453],
            'sóc trăng' => ['lat' => 9.6004, 'lng' => 105.9800],
            'an giang' => ['lat' => 10.5216, 'lng' => 105.1259],
            'kiên giang' => ['lat' => 9.8249, 'lng' => 105.1259],
            'cà mau' => ['lat' => 9.1767, 'lng' => 105.1524],
            'bạc liêu' => ['lat' => 9.2945, 'lng' => 105.7272],
            'hậu giang' => ['lat' => 9.7843, 'lng' => 105.4701],
            'đồng tháp' => ['lat' => 10.4500, 'lng' => 105.6333]
        ];
        
        // Tìm tọa độ dựa trên địa chỉ
        foreach ($coordinatesDB as $province => $coords) {
            if (strpos($address, $province) !== false) {
                return $coords;
            }
        }
        
        return null;
    }
}