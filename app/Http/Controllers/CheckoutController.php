<?php

namespace App\Http\Controllers;
use Validate;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\SubCategories;
use App\Models\ProductsImages;
use App\Models\ProductCombination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Http\Request;
session_start();

class CheckoutController extends Controller
{   
    public function checkout(){
        $user_id = Session::get('user_id');
        $shop_id = request('choice-shop');
        $shop = DB::table('shop')
            ->where('id', $shop_id)
            ->select( 'id', 'shopname', 'shopImg',)
            ->first();
        $product_cart = DB::table('cart')
            ->join('shop', 'cart.shop_id', '=', 'shop.id')
            ->where('user_id', $user_id)
            ->where('shop_id', $shop_id)
            ->select('shop_id', 'product_id', 'productName' ,'product_price', 'quantity', 'combination', 'product_image','combination_id')
            ->get();
        $total_price = 0;
        foreach($product_cart as $key => $cart){
                $total_price += $cart->product_price * $cart->quantity;
            }
        $coupon = DB::table('coupon')
            ->get();
        // $total_price = number_format($total_price, 0, ',', '.');
        // dd($shop);
        return view('user.checkout', compact('shop', 'product_cart', 'total_price','coupon'));
    }
    public function order(Request $request){
        $user_id = Session::get('user_id');
        $shop_id = $request->shop_id;
        if ($request->ship_email == null) {
            $ship_email = "";
        } else {
            $ship_email = $request->ship_email;
        }
        if ($request->note == null) {
            $note = "";
        } else {
            $note = $request->note;
        }
        if($request->coupon_code != null){
            $coupon = DB::table('coupon')
                ->where('coupon_code', $request->coupon_code)
                ->update(['coupon_amount' => DB::raw('coupon_amount - 1')]);
        }
        $pre_address = $request->pre_address;
        $detail_address = $request->detail_address;
        $ship_address = $pre_address . $detail_address;

        if ($request->payment_option==0) {
            // insert payment method
            $payment_data = array();
            $payment_data['payment_method'] = $request->payment_option;
            $payment_data['shop_id'] = $shop_id ;
            $payment_data['user_id'] = $user_id;
            $payment_data['payment_status'] = "0";
            $payment_id = Payment::insertGetId($payment_data);
            // insert shipping
            $shipping_data = array(
                'user_id' => $user_id,
                'shop_id' => $shop_id,
                'ship_name' => $request->ship_name,
                'ship_phonenumber' => $request->ship_phonenumber,
                'ship_email' => $ship_email,
                'ship_address' => $ship_address,
                'note' => $note,
                'total_price' => Session::get('total_price'),
                'ship_status' => "0",
            );
            $shipping_id = Shipping::insertGetId($shipping_data);

            // insert order
            $order_data = array();
            $order_data['user_id'] = $user_id;
            $order_data['shop_id'] = $shop_id;
            $order_data['payment_id'] = $payment_id;
            $order_data['shipping_id'] = $shipping_id;
            $order_data['order_total'] = Session::get('total_price');
            $order_data['order_status'] = "0";
            $order_data['created_at'] = now();
            $order_data['updated_at'] = now();
            $order_id = Order::insertGetId($order_data);
            // insert order detail
            $cart = Cart::where('user_id', $user_id)->where('shop_id', $shop_id)->get();
            foreach($cart as $key => $cart){
                $order_detail_data = array();
                $order_detail_data['order_id'] = $order_id;
                $order_detail_data['product_id'] = $cart->product_id;
                $order_detail_data['shop_id'] = $shop_id ;
                $order_detail_data['user_id'] = $user_id;
                $order_detail_data['product_name'] = $cart->productName;
                $order_detail_data['product_price'] = $cart->product_price;
                $order_detail_data['product_quantity'] = $cart->quantity;
                $order_detail_data['combination_id'] = $cart->combination_id;
                if ($cart->combination == null) {
                    $order_detail_data['product_combination'] = "";

                } else {
                    $order_detail_data['product_combination'] = $cart->combination;

                }
                $order_detail_data['created_at'] = now();
                $order_detail_data['updated_at'] = now();
                OrderDetail::insert($order_detail_data);
            }
            Cart::where('user_id', $user_id)->where('shop_id', $shop_id)->delete();
            $count_cart = DB::table('cart')
                ->where('user_id', $user_id)
                ->count();
            Session::put('count_cart',$count_cart);
            Session::forget('total_price');
            return Redirect()-> route('after_order');
        }
        
    }
    public function buy_now_ajax(){
        $user_id = Session::get('user_id');
        $data = request()->all();
        $shop_id = $data['shop_id'];
      
        $shop = DB::table('shop')
            ->where('id', $shop_id)
            ->select( 'id', 'shopname', 'shopImg',)
            ->first();
        $product_id = $data['product_id'];
        $product_buy = DB::table('products')
            ->where('id', $product_id)
            ->select('id', 'productName', 'price', 'previewImage')
            ->first();
        $quantity = $data['quantity'];
        $combination = $data['combination'];
        $combination_id = $data['combination_id'];
        $total_price = 0;
        $total_price += $product_buy->price * $quantity;
        Session::put('product_buy',$product_buy);
        Session::put('quantity_now',$quantity);
        Session::put('combination_now',$combination);
        Session::put('total_price_now',$total_price);
        Session::put('shop_now',$shop);
        Session::put('combination_id_now',$combination_id);
        // $total_price = number_format($total_price, 0, ',', '.');
        // dd($shop);
        return response()->json([
            'status' => true
        ]);
    }
    public function checkout_now(){
        $user_id = Session::get('user_id');
        $shop = Session::get('shop_now');
        $product_buy = Session::get('product_buy');
        $quantity = Session::get('quantity_now');
        $combination = Session::get('combination_now');
        $total_price = Session::get('total_price_now');
        $combination_id = Session::get('combination_id_now');
        $coupon = DB::table('coupon')
            ->get();
        
        // Session::forget('product_buy');
        // Session::forget('quantity_now');
        // Session::forget('combination_now');
        // Session::forget('total_price_now');
        // Session::forget('shop_now');
        return view('user.checkout_now', compact('shop', 'product_buy', 'quantity', 'combination', 'total_price', 'coupon','combination_id'));
    }
    public function order_now(Request $request){
        $user_id = Session::get('user_id');
        $shop_id = $request->shop_id;
        if ($request->ship_email == null) {
            $ship_email = "";
        } else {
            $ship_email = $request->ship_email;
        }
        if ($request->note == null) {
            $note = "";
        } else {
            $note = $request->note;
        }
        
        $pre_address = $request->pre_address;
        $detail_address = $request->detail_address;
        $ship_address = $pre_address . $detail_address;
        if($request->coupon_code != null){
            $coupon = DB::table('coupon')
                ->where('coupon_code', $request->coupon_code)
                ->update(['coupon_amount' => DB::raw('coupon_amount - 1')]);
        }
        if ($request->payment_option==0) {
            // insert payment method
            $payment_data = array();
            $payment_data['payment_method'] = $request->payment_option;
            $payment_data['shop_id'] = $shop_id ;
            $payment_data['user_id'] = $user_id;
            $payment_data['payment_status'] = "0";
            $payment_id = Payment::insertGetId($payment_data);
            // insert shipping
            $shipping_data = array(
                'user_id' => $user_id,
                'shop_id' => $shop_id,
                'ship_name' => $request->ship_name,
                'ship_phonenumber' => $request->ship_phonenumber,
                'ship_email' => $ship_email,
                'ship_address' => $ship_address,
                'note' => $note,
                'total_price' => Session::get('total_price_now_'),
                'ship_status' => "0",
            );
            $shipping_id = Shipping::insertGetId($shipping_data);

            // insert order
            $order_data = array();
            $order_data['user_id'] = $user_id;
            $order_data['shop_id'] = $shop_id;
            $order_data['payment_id'] = $payment_id;
            $order_data['shipping_id'] = $shipping_id;
            $order_data['order_total'] = Session::get('total_price_now_');
            $order_data['order_status'] = "0";
            $order_data['created_at'] = now();
            $order_data['updated_at'] = now();
            $order_id = Order::insertGetId($order_data);
            // insert order detail
            $order_detail_data = array();
            $order_detail_data['order_id'] = $order_id;
            $order_detail_data['product_id'] = $request->product_id;
            $order_detail_data['shop_id'] = $shop_id ;
            $order_detail_data['user_id'] = $user_id;
            $order_detail_data['product_name'] = $request->productName;
            $order_detail_data['product_price'] = $request->price;
            $order_detail_data['product_quantity'] = $request->quantity;
            $order_detail_data['combination_id'] = $request->combination_id;
            if ($request->combination == null) {
                $order_detail_data['product_combination'] = "";

            } else {
                $order_detail_data['product_combination'] = $request->combination;

            }
            $order_detail_data['created_at'] = now();
            $order_detail_data['updated_at'] = now();
            OrderDetail::insert($order_detail_data);

            
            $count_cart = DB::table('cart')
                ->where('user_id', $user_id)
                ->count();
            Session::put('count_cart',$count_cart);
            Session::forget('total_price_now_');
            Session::forget('total_price_now');
            Session::forget('product_buy');
            Session::forget('quantity_now');
            Session::forget('combination_now');
            Session::forget('shop_now');
            Session::forget('combination_id_now');
            return Redirect()-> route('after_order');
        }
    }
    public function after_order(){
        return view('user.after_order');
    }
    public function review_order(){
        $user_id = Session::get('user_id');
        $order = DB::table('order')
            ->where('user_id', $user_id)
            ->select('order.*', 'shop.shopname')
            ->get();
        return view('user.order_history', compact('order'));
    }
    public function user_purchase(){
        $user_id = Session::get('user_id');
        $orders = DB::table('orders')
            ->join('shop', 'shop.id', '=', 'orders.shop_id')
            ->where('user_id', $user_id)
            ->select('orders.id','orders.shop_id','orders.user_id','orders.order_status','orders.order_total','shop.shopname','shop.shopImg')
            ->orderBy('orders.id', 'desc')
            ->get();
        $order_product = DB::table('order_detail')
            ->join('orders', 'orders.id', '=', 'order_detail.order_id')
            ->join('products','products.id', '=', 'order_detail.product_id')
            ->where('order_detail.user_id', $user_id)
            ->select('order_detail.*','orders.id','products.id','products.price','products.previewImage')
            ->get();
        foreach($orders as $key => $order){
            $orders[$key]->order_product = DB::table('order_detail')
                ->join('orders', 'orders.id', '=', 'order_detail.order_id')
                ->join('products','products.id', '=', 'order_detail.product_id')
                ->where('order_detail.user_id', $user_id)
                ->where('order_detail.order_id', $order->id)
                ->select('order_detail.*','orders.id','products.id','products.price','products.previewImage')
                ->get();
        }
        // dd($orders);
        return view('user.purchase', compact('orders','order_product'));
    }
    public function user_purchase_detail($id){
        $user_id = Session::get('user_id');
        $order = DB::table('orders')
            ->join('shop', 'shop.id', '=', 'orders.shop_id')
            ->where('user_id', $user_id)
            ->where('orders.id', $id)
            ->select('orders.id','orders.shop_id','orders.user_id','orders.order_status','orders.order_total','shop.shopname','shop.shopImg')
            ->first();
        $order_product = DB::table('order_detail')
            ->join('orders', 'orders.id', '=', 'order_detail.order_id')
            ->join('products','products.id', '=', 'order_detail.product_id')
            ->where('order_detail.user_id', $user_id)
            ->where('order_detail.order_id', $id)
            ->select('order_detail.*','orders.id','products.id','products.price','products.previewImage')
            ->get();
        // dd($order_product);
        return view('user.purchase_detail', compact('order','order_product'));
    }
    public function user_account(){
        $user_id = Session::get('user_id');
        // dd(Session::get('user_img'));
        $user = DB::table('users')
            ->where('id', $user_id)
            ->first();
        return view('user.user_account', compact('user'));
    }
    public function change_profile_user(Request $request){
       
        $user_id = Session::get('user_id');
        $user_img = Session::get('user_img');
        $email_all = DB::table('users')
            ->select('email')
            ->where('id', '!=', $user_id)
            ->get();
        foreach($email_all as $key => $email){
            if($email->email == request('email')){
                return redirect()->route('user_account')->with('error','Email đã tồn tại');
            }
        }
        $user = DB::table('users')
            ->where('id', $user_id)
            ->first();
        $data = array();
        $data['firstname'] = request('first_name');
        $data['lastname'] = request('last_name');
        $data['email'] = request('email');
        
        $data['updated_at'] = now();
        if(request()->hasFile('user_img')){
            $file = request()->file('user_img')->store('users_img','public');
            if($user_img != null){
                unlink('storage/'.$user_img);
            }
            $data['userImg'] = $file;
            DB::table('users')->where('id', $user_id)->update($data);
            Session::put('user_img',$data['userImg']);
        }
        DB::table('users')->where('id', $user_id)->update($data);
        Session::put('user_name',$data['firstname'].' '.$data['lastname']);
        
        return redirect()->route('user_account')->with('success','Cập nhật thành công');
    }
    public function user_password(){
        return view('user.user_password');
    }
    public function change_password_user(Request $request){
        $user_id = Session::get('user_id');
        $user = DB::table('users')
            ->where('id', $user_id)
            ->first();
        $old_password = $user->password;
        
        if (Hash::check($request->pre_password, $old_password )) {
            $data = array();
            $data['password'] = Hash::make(request('password'));
            $data['updated_at'] = now();
            DB::table('users')->where('id', $user_id)->update($data);
            return redirect()->route('user_password')->with('message','Cập nhật thành công');
        }
        return redirect()->route('user_password')->with('error','Mật khẩu cũ không đúng');
    }
    public function choose_coupon_now(){
        $user_id = Session::get('user_id');
        $coupon_code = request('coupon_code');
        $total_price = request('total_price');
        $coupon = DB::table('coupon')
            ->where('coupon_code', $coupon_code)
            ->first();
        if($coupon == null){
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá không tồn tại',
            ]);
        }
        if($coupon->coupon_amount == 0){
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá đã hết hạn',
            ]);
        }
        if ($coupon->coupon_condition > $total_price) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng của bạn không đủ điều kiện để áp dụng mã giảm giá này',
            ]);
        } else {
            if ($coupon->coupon_type == 1) {
                $total_price = $total_price - $coupon->coupon_value;
                $coupon_number = $coupon->coupon_value; // số tiền giảm
                $total_price_display = number_format($total_price+30000, 0, ',', '.');
                Session::put('total_price_now_',$total_price+30000);
                $html = view('user.ajax_coupon', compact('coupon_number','coupon_code'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Áp dụng mã giảm giá thành công',
                    'coupon_number' => $coupon_number,
                    'html' => $html,
                    'total_price_display' => $total_price_display,
                    
                ]);
            } else {
                $coupon_number = $total_price * $coupon->coupon_value/100; // số tiền giảm
                $total_price = $total_price - ($total_price * $coupon->coupon_value)/100; 
                $total_price_display = number_format($total_price+30000, 0, ',', '.');
                Session::put('total_price_now_',$total_price+30000);
                $html = view('user.ajax_coupon', compact('coupon_number','coupon_code'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Áp dụng mã giảm giá thành công',
                    'coupon_number' => $coupon_number,
                    'total_price_display' => $total_price_display,
                    'html' => $html,
                    
                ]);
            }
        }
    }
    public function choose_coupon(){
        $user_id = Session::get('user_id');
        $coupon_code = request('coupon_code');
        $total_price = request('total_price');
        $coupon = DB::table('coupon')
            ->where('coupon_code', $coupon_code)
            ->first();
        if($coupon == null){
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá không tồn tại',
            ]);
        }
        if($coupon->coupon_amount == 0){
            return response()->json([
                'status' => false,
                'message' => 'Mã giảm giá đã hết hạn',
            ]);
        }
        if ($coupon->coupon_condition > $total_price) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng của bạn không đủ điều kiện để áp dụng mã giảm giá này',
            ]);
        } else {
            if ($coupon->coupon_type == 1) {
                $total_price = $total_price - $coupon->coupon_value;
                $coupon_number = $coupon->coupon_value; // số tiền giảm
                $total_price_display = number_format($total_price+30000, 0, ',', '.');
                Session::put('total_price',$total_price+30000);
                $html = view('user.ajax_coupon', compact('coupon_number','coupon_code'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Áp dụng mã giảm giá thành công',
                    'coupon_number' => $coupon_number,
                    'html' => $html,
                    'total_price_display' => $total_price_display,
                    
                ]);
            } else {
                $coupon_number = $total_price * $coupon->coupon_value/100; // số tiền giảm
                $total_price = $total_price - ($total_price * $coupon->coupon_value)/100; 
                $total_price_display = number_format($total_price+30000, 0, ',', '.');
                Session::put('total_price',$total_price+30000);
                $html = view('user.ajax_coupon', compact('coupon_number','coupon_code'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Áp dụng mã giảm giá thành công',
                    'coupon_number' => $coupon_number,
                    'total_price_display' => $total_price_display,
                    'html' => $html,
                    
                ]);
            }
        }
    }
}
