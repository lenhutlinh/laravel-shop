<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\CommissionRate;

class CommissionRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy tất cả các shop đang hoạt động
        $shops = Shop::where('status', '1')->get();

        foreach ($shops as $shop) {
            // Kiểm tra xem shop đã có commission rate chưa
            $existingCommission = CommissionRate::where('shop_id', $shop->id)->first();
            
            if (!$existingCommission) {
                CommissionRate::create([
                    'shop_id' => $shop->id,
                    'rate' => 4.00, // Tỷ lệ hoa hồng mặc định 4%
                    'total_commission' => 0.00,
                    'pending_commission' => 0.00,
                    'paid_commission' => 0.00,
                    'status' => 'active'
                ]);
            }
        }
    }
}