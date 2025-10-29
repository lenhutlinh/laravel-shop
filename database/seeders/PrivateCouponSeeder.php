<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrivateCoupon;
use App\Models\User;
use Carbon\Carbon;

class PrivateCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy admin đầu tiên làm người tạo
        $admin = User::where('role_id', '1')->first();
        if (!$admin) {
            $this->command->error('Không tìm thấy admin để tạo private coupons');
            return;
        }

        $privateCoupons = [
            [
                'code' => 'NHUTLINH2025',
                'name' => 'Mã giảm giá đặc biệt cho khách VIP',
                'description' => 'Mã giảm giá riêng dành cho khách hàng VIP',
                'type' => 'percentage',
                'value' => 15.00,
                'minimum_amount' => 500000,
                'maximum_discount' => 200000,
                'usage_limit' => 100,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(3),
                'is_active' => true,
                'shop_id' => null, // Áp dụng cho tất cả shop
                'created_by' => $admin->id
            ],
            [
                'code' => 'WELCOME2025',
                'name' => 'Chào mừng năm mới 2025',
                'description' => 'Mã giảm giá chào mừng năm mới',
                'type' => 'fixed',
                'value' => 100000,
                'minimum_amount' => 300000,
                'maximum_discount' => null,
                'usage_limit' => 50,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'is_active' => true,
                'shop_id' => null,
                'created_by' => $admin->id
            ],
            [
                'code' => 'VIPCUSTOMER',
                'name' => 'Khách hàng VIP',
                'description' => 'Mã giảm giá dành riêng cho khách hàng VIP',
                'type' => 'percentage',
                'value' => 20.00,
                'minimum_amount' => 1000000,
                'maximum_discount' => 500000,
                'usage_limit' => 20,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(6),
                'is_active' => true,
                'shop_id' => null,
                'created_by' => $admin->id
            ]
        ];

        foreach ($privateCoupons as $couponData) {
            PrivateCoupon::create($couponData);
        }

        $this->command->info('Đã tạo ' . count($privateCoupons) . ' mã giảm giá riêng mẫu');
    }
}
