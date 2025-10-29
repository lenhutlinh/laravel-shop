<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\CommissionRate;
use App\Models\Order;

class CommissionSyncService
{
    /**
     * Đồng bộ dữ liệu hoa hồng cho một shop cụ thể
     */
    public function syncShopCommission($shopId)
    {
        try {
            // Lấy tất cả đơn hàng của shop (tính hoa hồng cho tất cả đơn hàng)
            $orders = Order::where('shop_id', $shopId)
                ->whereIn('order_status', [0, 1, 3, 4, 5]) // Tất cả đơn hàng trừ hủy
                ->get();
            
            // Lấy hoặc tạo CommissionRate
            $commissionRate = CommissionRate::where('shop_id', $shopId)->first();
            if (!$commissionRate) {
                $commissionRate = CommissionRate::create([
                    'shop_id' => $shopId,
                    'rate' => 4.00,
                    'total_commission' => 0.00,
                    'pending_commission' => 0.00,
                    'paid_commission' => 0.00,
                    'status' => 'active'
                ]);
            }
            
            $totalCommission = 0;
            $pendingCommission = 0;
            $paidCommission = 0;
            
            foreach ($orders as $order) {
                // Tính hoa hồng chính xác theo công thức mới
                // Lấy dữ liệu từ order_detail để tính đúng
                $orderDetails = DB::table('order_detail')->where('order_id', $order->id)->first();
                
                if ($orderDetails) {
                    // Công thức mới: net_price = product_price - coupon_discount
                    $product_price = $orderDetails->product_price * $orderDetails->product_quantity;
                    $coupon_discount = $orderDetails->coupon_discount ?? 0;
                    $net_price = $product_price - $coupon_discount;
                    $correctCommissionAmount = $net_price * 0.04;
                } else {
                    // Fallback cho đơn hàng cũ
                    $correctCommissionAmount = $order->order_total * 0.04;
                }
                
                // Kiểm tra order_commission hiện tại
                $orderCommission = DB::table('order_commissions')
                    ->where('order_id', $order->id)
                    ->first();
                
                if (!$orderCommission) {
                    // Tạo mới order_commission
                    $status = $order->order_status == 5 ? 'completed' : 'pending';
                    DB::table('order_commissions')->insert([
                        'order_id' => $order->id,
                        'shop_id' => $shopId,
                        'commission_amount' => $correctCommissionAmount,
                        'status' => $status,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    $orderCommission = (object)[
                        'commission_amount' => $correctCommissionAmount,
                        'status' => $status
                    ];
                } else {
                    // Cập nhật nếu cần thiết
                    $needsUpdate = false;
                    $updateData = [];
                    
                    // Kiểm tra commission amount
                    if (abs($orderCommission->commission_amount - $correctCommissionAmount) > 0.01) {
                        $updateData['commission_amount'] = $correctCommissionAmount;
                        $needsUpdate = true;
                    }
                    
                    // Kiểm tra status
                    $correctStatus = $order->order_status == 5 ? 'completed' : 'pending';
                    if ($orderCommission->status != $correctStatus) {
                        $updateData['status'] = $correctStatus;
                        $needsUpdate = true;
                    }
                    
                    if ($needsUpdate) {
                        $updateData['updated_at'] = now();
                        DB::table('order_commissions')
                            ->where('order_id', $order->id)
                            ->update($updateData);
                        
                        $orderCommission->commission_amount = $updateData['commission_amount'] ?? $orderCommission->commission_amount;
                        $orderCommission->status = $updateData['status'] ?? $orderCommission->status;
                    }
                }
                
                $totalCommission += $orderCommission->commission_amount;
                
                if ($orderCommission->status == 'completed') {
                    $paidCommission += $orderCommission->commission_amount;
                } else {
                    $pendingCommission += $orderCommission->commission_amount;
                }
            }
            
            // Cập nhật CommissionRate
            $commissionRate->update([
                'total_commission' => $totalCommission,
                'pending_commission' => $pendingCommission,
                'paid_commission' => $paidCommission
            ]);
            
            return true;
            
        } catch (\Exception $e) {
            \Log::error("Error syncing commission data for shop #{$shopId}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Đồng bộ dữ liệu hoa hồng cho tất cả shops
     */
    public function syncAllShopsCommission()
    {
        try {
            $shops = DB::table('shop')->where('status', '1')->get();
            
            foreach ($shops as $shop) {
                $this->syncShopCommission($shop->id);
            }
            
            return true;
            
        } catch (\Exception $e) {
            \Log::error("Error syncing all shops commission data: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Tính hoa hồng cho đơn hàng mới
     */
    public function calculateOrderCommission($orderId, $shopId, $orderTotal, $status)
    {
        try {
            // Chỉ tính hoa hồng nếu shop đã được duyệt (status = 1)
            $shop = DB::table('shop')->where('id', $shopId)->first();
            if (!$shop || $shop->status != '1') {
                return false; // Shop chưa được duyệt, không tính hoa hồng
            }

            // Tìm hoặc tạo commission rate cho shop
            $commissionRate = CommissionRate::where('shop_id', $shopId)->first();
            
            if (!$commissionRate) {
                // Tạo commission rate mặc định nếu chưa có
                $commissionRate = CommissionRate::create([
                    'shop_id' => $shopId,
                    'rate' => 4.00,
                    'total_commission' => 0.00,
                    'pending_commission' => 0.00,
                    'paid_commission' => 0.00,
                    'status' => 'active'
                ]);
            }

            // Tính hoa hồng theo công thức mới
            // Lấy dữ liệu từ order_detail để tính đúng
            $orderDetails = DB::table('order_detail')->where('order_id', $orderId)->first();
            
            if ($orderDetails) {
                // Công thức mới: net_price = product_price - coupon_discount
                $product_price = $orderDetails->product_price * $orderDetails->product_quantity;
                $coupon_discount = $orderDetails->coupon_discount ?? 0;
                $net_price = $product_price - $coupon_discount;
                $commissionAmount = $commissionRate->calculateCommission($net_price);
            } else {
                // Fallback cho đơn hàng cũ
                $commissionAmount = $commissionRate->calculateCommission($orderTotal);
            }
            
            // Kiểm tra xem đơn hàng này đã được tính hoa hồng chưa
            $existingOrder = DB::table('order_commissions')->where('order_id', $orderId)->first();
            
            if (!$existingOrder) {
                // Xác định status cho order_commissions
                $commissionStatus = ($status == 5) ? 'completed' : 'pending';
                
                // Thêm vào order_commissions
                DB::table('order_commissions')->insert([
                    'order_id' => $orderId,
                    'shop_id' => $shopId,
                    'commission_amount' => $commissionAmount,
                    'status' => $commissionStatus,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                // Cập nhật hoa hồng vào commission rate
                if ($status == 5) {
                    // Đơn hàng hoàn thành -> chuyển sang đã thu
                    $commissionRate->addCommission($commissionAmount);
                } else {
                    // Đơn hàng đang xử lý -> thêm vào đang xử lý
                    $commissionRate->addPendingCommission($commissionAmount);
                }
                
                \Log::info("Commission calculated for Order #{$orderId} (Status: {$status}): {$commissionAmount} VNĐ (Rate: {$commissionRate->rate}%)");
            } else {
                // Đơn hàng đã có hoa hồng, cần cập nhật status nếu cần
                if ($status == 5 && $existingOrder->status == 'pending') {
                    // Chuyển từ pending sang completed
                    DB::table('order_commissions')
                        ->where('order_id', $orderId)
                        ->update(['status' => 'completed', 'updated_at' => now()]);
                    
                    // Chuyển hoa hồng từ pending sang paid
                    $commissionRate->completeCommission($commissionAmount);
                    
                    \Log::info("Commission completed for Order #{$orderId}: {$commissionAmount} VNĐ");
                } elseif (in_array($status, [1, 3, 4]) && $existingOrder->status == 'completed') {
                    // Chuyển từ completed về pending (khi đơn hàng không còn hoàn thành)
                    DB::table('order_commissions')
                        ->where('order_id', $orderId)
                        ->update(['status' => 'pending', 'updated_at' => now()]);
                    
                    // Chuyển hoa hồng từ paid về pending
                    $commissionRate->revertCommission($commissionAmount);
                    
                    \Log::info("Commission reverted for Order #{$orderId}: {$commissionAmount} VNĐ");
                }
            }

            return true;

        } catch (\Exception $e) {
            \Log::error("Error calculating commission for Order #{$orderId}: " . $e->getMessage());
            return false;
        }
    }
}
