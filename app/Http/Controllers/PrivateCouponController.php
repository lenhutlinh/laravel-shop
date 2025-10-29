<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivateCoupon;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PrivateCouponController extends Controller
{
    /**
     * Hiển thị danh sách mã giảm giá riêng
     */
    public function index()
    {
        $privateCoupons = PrivateCoupon::with(['shop', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.private_coupons.index', compact('privateCoupons'));
    }

    /**
     * Hiển thị form tạo mã giảm giá riêng
     */
    public function create()
    {
        $shops = Shop::where('status', 1)->get();
        return view('admin.private_coupons.create', compact('shops'));
    }

    /**
     * Lưu mã giảm giá riêng mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:private_coupons,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'shop_id' => 'nullable|exists:shop,id',
            'is_active' => 'boolean'
        ]);

        try {
            PrivateCoupon::create([
                'code' => strtoupper($request->code),
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'value' => $request->value,
                'minimum_amount' => $request->minimum_amount,
                'maximum_discount' => $request->maximum_discount,
                'usage_limit' => $request->usage_limit,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'shop_id' => $request->shop_id,
                'is_active' => $request->has('is_active'),
                'created_by' => Session::get('admin_id')
            ]);

            Session::put('message', 'Tạo mã giảm giá riêng thành công!');
            return redirect()->route('private_coupons.index');
        } catch (\Exception $e) {
            Session::put('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit($id)
    {
        $privateCoupon = PrivateCoupon::findOrFail($id);
        $shops = Shop::where('status', 1)->get();
        return view('admin.private_coupons.edit', compact('privateCoupon', 'shops'));
    }

    /**
     * Cập nhật mã giảm giá riêng
     */
    public function update(Request $request, $id)
    {
        $privateCoupon = PrivateCoupon::findOrFail($id);
        
        $request->validate([
            'code' => 'required|string|max:255|unique:private_coupons,code,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'shop_id' => 'nullable|exists:shop,id',
            'is_active' => 'boolean'
        ]);

        try {
            $privateCoupon->update([
                'code' => strtoupper($request->code),
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'value' => $request->value,
                'minimum_amount' => $request->minimum_amount,
                'maximum_discount' => $request->maximum_discount,
                'usage_limit' => $request->usage_limit,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'shop_id' => $request->shop_id,
                'is_active' => $request->has('is_active')
            ]);

            Session::put('message', 'Cập nhật mã giảm giá riêng thành công!');
            return redirect()->route('private_coupons.index');
        } catch (\Exception $e) {
            Session::put('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Xóa mã giảm giá riêng
     */
    public function destroy($id)
    {
        try {
            $privateCoupon = PrivateCoupon::findOrFail($id);
            $privateCoupon->delete();
            
            Session::put('message', 'Xóa mã giảm giá riêng thành công!');
            return redirect()->route('private_coupons.index');
        } catch (\Exception $e) {
            Session::put('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * API: Kiểm tra mã giảm giá riêng
     */
    public function checkPrivateCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'order_amount' => 'required|numeric|min:0'
        ]);

        $privateCoupon = PrivateCoupon::where('code', strtoupper($request->code))
            ->where('is_active', true)
            ->first();

        if (!$privateCoupon) {
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá không tồn tại hoặc đã hết hạn'
            ]);
        }

        if (!$privateCoupon->isValid()) {
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá không còn hiệu lực'
            ]);
        }

        $discount = $privateCoupon->calculateDiscount($request->order_amount);

        if ($discount <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng không đủ điều kiện áp dụng mã giảm giá'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Áp dụng mã giảm giá thành công',
            'discount' => $discount,
            'coupon' => [
                'id' => $privateCoupon->id,
                'code' => $privateCoupon->code,
                'name' => $privateCoupon->name,
                'type' => $privateCoupon->type,
                'value' => $privateCoupon->value
            ]
        ]);
    }
}
