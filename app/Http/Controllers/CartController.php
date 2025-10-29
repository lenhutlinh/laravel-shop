<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ProductsImages;
use App\Models\ProductCombination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;


class CartController extends Controller
{
    public function minus_cart_ajax(Request $request){
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $user_id = Session::get('user_id');
        $cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->where('id', $data['id'])
            ->first();
        $quantity = $data['quantity'];
        $quantity = $quantity -1;
        
        if ($quantity < 1) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không thể mua ít hơn 1 sản phẩm',
            ]);
        }else{
            $cart = DB::table('cart')
                ->where('user_id', $user_id)
                ->where('id', $data['id'])
                ->update([
                    'quantity' => $quantity
                ]);
            $shop_sum = DB::table('cart')
                ->where('user_id', $user_id)
                ->select('shop_id', )
                ->groupBy('shop_id')
                ->get();
            $product_cart = DB::table('cart')
                ->join('shop', 'cart.shop_id', '=', 'shop.id')
                ->where('user_id', $user_id)
                ->select('shop_id', 'shopname', 'shopImg', 'cart.product_id', 
                'cart.productName', 'cart.product_price', 'cart.product_image', 'cart.quantity', 
                'cart.avaiable_stock', 'cart.combination')
                ->get();
    
            foreach($shop_sum as $key => $shop){
                $shop_sum[$key]->product_cart = DB::table('cart')
                    ->join('shop', 'cart.shop_id', '=', 'shop.id')
                    ->where('user_id', $user_id)
                    ->where('shop_id', $shop->shop_id)
                    ->select('cart.id', 'shop_id', 'shopname', 'shopImg', 'cart.product_id', 
                    'cart.productName', 'cart.product_price', 'cart.product_image', 'cart.quantity', 
                    'cart.avaiable_stock', 'cart.combination')
                    ->orderBy('cart.id', 'desc')
                    ->get();
            }
            $html = view('user.update_quantity_cart',compact('shop_sum','product_cart'))->render();
            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
        }
    }
    public function plus_cart_ajax(Request $request){
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $user_id = Session::get('user_id');
        $cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->where('id', $data['id'])
            ->first();
        $quantity = $data['quantity'];
        $quantity = $quantity + 1;
        
        if ($quantity > $data['avaiable_stock']) {
            return response()->json([
                'message' => 'Số lượng sản phẩm trong kho không đủ',
                'status' => false
            ]);
        }else{
            $cart = DB::table('cart')
                ->where('user_id', $user_id)
                ->where('id', $data['id'])
                ->update([
                    'quantity' => $quantity
                ]);
            $shop_sum = DB::table('cart')
                ->where('user_id', $user_id)
                ->select('shop_id', )
                ->groupBy('shop_id')
                ->get();
            $product_cart = DB::table('cart')
                ->join('shop', 'cart.shop_id', '=', 'shop.id')
                ->where('user_id', $user_id)
                ->select('shop_id', 'shopname', 'shopImg', 'cart.product_id', 
                'cart.productName', 'cart.product_price', 'cart.product_image', 'cart.quantity', 
                'cart.avaiable_stock', 'cart.combination')
                ->get();
    
            foreach($shop_sum as $key => $shop){
                $shop_sum[$key]->product_cart = DB::table('cart')
                    ->join('shop', 'cart.shop_id', '=', 'shop.id')
                    ->where('user_id', $user_id)
                    ->where('shop_id', $shop->shop_id)
                    ->select('cart.id', 'shop_id', 'shopname', 'shopImg', 'cart.product_id', 
                    'cart.productName', 'cart.product_price', 'cart.product_image', 'cart.quantity', 
                    'cart.avaiable_stock', 'cart.combination')
                    ->orderBy('cart.id', 'desc')
                    ->get();
            }
            $html = view('user.update_quantity_cart',compact('shop_sum','product_cart'))->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }
    
    public function delete_cart_ajax(Request $request){
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $user_id = Session::get('user_id');
        $cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->where('id', $data['id'])
            ->delete();
        $count_cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->count();
        Session::put('count_cart',$count_cart);
        Session::save();
        return response()->json([
            'status' => true
        ]);
    }
    public function update_cart_ajax(Request $request){
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $user_id = Session::get('user_id');
        $quantity = $data['quantity'];

        if ($quantity < 1) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không thể mua ít hơn 1 sản phẩm',
            ]);
        }
        if ($quantity > $data['avaiable_stock']) {
            return response()->json([
                'message' => 'Số lượng sản phẩm trong kho không đủ',
                'status' => false
            ]);
        }
        $cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->where('id', $data['id'])
            ->update([
                'quantity' => $quantity
            ]);
        return response()->json([
            'status' => true
        ]);
    }

    public function choose_shop(){
        $user_id = Session::get('user_id');
        $shop_id = request()->shop_id;

        $product_cart = DB::table('cart')
            ->join('shop', 'cart.shop_id', '=', 'shop.id')
            ->where('user_id', $user_id)
            ->where('shop_id', $shop_id)
            ->select('shop_id', 'cart.product_price', 'cart.quantity')
            ->get();
        
        $count_price = 0;
        foreach($product_cart as $key => $cart){
            // Convert string to float for calculation
            $price = floatval($cart->product_price);
            $quantity = intval($cart->quantity);
            $count_price += $price * $quantity;
        }
        
        // Format the price with Vietnamese currency format
        $count_price = number_format($count_price, 0, ',', '.') . '₫';
        
        return response()->json([
            'status' => true,
            'count_price' => $count_price,
        ]);
    }
    
}
