<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\OrderComment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'shop_id' => 'required|exists:shop,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user_id = Session::get('user_id');
        
        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng đăng nhập để đánh giá'
            ]);
        }

        // Check if user already rated this product in this order
        $existingRating = Rating::where('user_id', $user_id)
            ->where('product_id', $request->product_id)
            ->where('order_id', $request->order_id)
            ->first();

        if ($existingRating) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn đã đánh giá sản phẩm này trong đơn hàng này rồi'
            ]);
        }

        // Check if order belongs to user and is completed
        $order = DB::table('orders')
            ->where('id', $request->order_id)
            ->where('user_id', $user_id)
            ->where('order_status', 5) // Only completed orders
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể đánh giá đơn hàng này'
            ]);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('rating_images', $imageName, 'public');
            }

            $rating = Rating::create([
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'order_id' => $request->order_id,
                'shop_id' => $request->shop_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'image' => $imagePath
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cảm ơn bạn đã đánh giá!',
                'rating' => $rating
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lưu đánh giá'
            ]);
        }
    }

    public function getProductRatings($product_id)
    {
        $ratings = Rating::with(['user', 'order'])
            ->where('product_id', $product_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $averageRating = $ratings->avg('rating');
        $totalRatings = $ratings->count();

        return response()->json([
            'ratings' => $ratings,
            'average_rating' => round($averageRating, 1),
            'total_ratings' => $totalRatings
        ]);
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'shop_id' => 'required|exists:shop,id',
            'comment' => 'required|string|max:1000'
        ]);

        $user_id = Session::get('user_id');
        
        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng đăng nhập để bình luận'
            ]);
        }

        // Check if order belongs to user and is completed
        $order = DB::table('orders')
            ->where('id', $request->order_id)
            ->where('user_id', $user_id)
            ->where('order_status', 5) // Only completed orders
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể bình luận đơn hàng này'
            ]);
        }

        try {
            // Create a comment record using OrderComment model
            $comment = OrderComment::create([
                'user_id' => $user_id,
                'order_id' => $request->order_id,
                'shop_id' => $request->shop_id,
                'comment' => $request->comment
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cảm ơn bạn đã bình luận!',
                'comment' => $comment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lưu bình luận: ' . $e->getMessage()
            ]);
        }
    }


}
