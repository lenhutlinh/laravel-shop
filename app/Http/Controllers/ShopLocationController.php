<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopLocationController extends Controller
{
    /**
     * Hiển thị danh sách shop và tọa độ
     */
    public function index()
    {
        $shops = Shop::select('id', 'shopname', 'email', 'address', 'latitude', 'longitude')
                    ->orderBy('id')
                    ->get();
        
        return view('admin.shop-locations', compact('shops'));
    }

    /**
     * Cập nhật tọa độ cho shop
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        $shop = Shop::findOrFail($id);
        $shop->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật tọa độ thành công!'
        ]);
    }

    /**
     * Lấy thông tin shop theo ID
     */
    public function show($id)
    {
        $shop = Shop::select('id', 'shopname', 'latitude', 'longitude')->findOrFail($id);
        
        return response()->json($shop);
    }

    /**
     * Cập nhật hàng loạt tọa độ cho nhiều shop
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'shops' => 'required|array',
            'shops.*.id' => 'required|exists:shop,id',
            'shops.*.latitude' => 'required|numeric|between:-90,90',
            'shops.*.longitude' => 'required|numeric|between:-180,180'
        ]);

        foreach ($request->shops as $shopData) {
            Shop::where('id', $shopData['id'])->update([
                'latitude' => $shopData['latitude'],
                'longitude' => $shopData['longitude']
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật tọa độ cho ' . count($request->shops) . ' shop thành công!'
        ]);
    }
}
