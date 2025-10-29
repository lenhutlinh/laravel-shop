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
use App\Models\CommissionRate;
use App\Services\CommissionSyncService;
use App\Services\ShippingCalculationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{   
    /**
     * Tính phí ship dựa trên vị trí shop thực tế
     */
    public function calculateShipping(Request $request)
    {
        try {
            $address = $request->input('address');
            $shopId = $request->input('shop_id');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            
            $shippingService = new ShippingCalculationService();
            $shippingInfo = $shippingService->getShippingInfo($shopId, $address, $latitude, $longitude);
            
            return response()->json([
                'success' => true,
                'shipping_cost' => $shippingInfo['shipping_cost'],
                'distance' => $shippingInfo['distance'],
                'message' => $shippingInfo['message'],
                'formatted_cost' => $shippingInfo['formatted_cost']
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error calculating shipping', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'shipping_cost' => 30000, // Phí ship mặc định khi shop chưa đăng ký
                'message' => 'Shop chưa đăng ký vị trí, sử dụng phí ship mặc định'
            ]);
        }
    }

    public function checkout(){
        $user_id = Session::get('user_id');
        $shop_id = request('choice-shop');
        $shop = DB::table('shop')
            ->where('id', $shop_id)
            ->select( 'id', 'shopname', 'shopImg', 'latitude', 'longitude', 'address')
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
        
        // Lưu tổng tiền vào session để sử dụng trong order()
        Session::put('total_price', $total_price);
        
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
            // Tính lại tổng tiền từ giỏ hàng để đảm bảo chính xác
            $cart_items = DB::table('cart')
                ->where('user_id', $user_id)
                ->where('shop_id', $shop_id)
                ->get();
            
            $base_price = 0;
            foreach($cart_items as $item) {
                $base_price += $item->product_price * $item->quantity;
            }
            
            $shipping_cost = $request->shipping_cost ?? 0; // Phí ship từ form
            $coupon_discount = 0; // Giảm giá coupon
            
            // Tính coupon_discount trước
            if ($request->coupon_code != null) {
                $coupon = DB::table('coupon')->where('coupon_code', $request->coupon_code)->first();
                if ($coupon) {
                    if ($coupon->coupon_type == 1) {
                        // Type 1: Giảm số tiền cố định
                        $coupon_discount = $coupon->coupon_value;
                    } else {
                        // Type 2: Giảm theo phần trăm
                        $coupon_discount = $base_price * $coupon->coupon_value / 100;
                    }
                }
            } else {
                $coupon_discount = 0;
            }
            
            // Tính tổng tiền cuối cùng: giá gốc + shipping - coupon
            $total_amount = $base_price + $shipping_cost - $coupon_discount;
            
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
                'total_price' => $total_amount,
                'ship_status' => "0",
            );
            $shipping_id = Shipping::insertGetId($shipping_data);

            // insert order
            $order_data = array();
            $order_data['user_id'] = $user_id;
            $order_data['shop_id'] = $shop_id;
            $order_data['payment_id'] = $payment_id;
            $order_data['shipping_id'] = $shipping_id;
            $order_data['order_total'] = $total_amount;
            $order_data['order_status'] = "0";
            $order_data['created_at'] = now();
            $order_data['updated_at'] = now();
            $order_id = Order::insertGetId($order_data);
            // insert order detail
            $cart = Cart::where('user_id', $user_id)->where('shop_id', $shop_id)->get();
            $is_first_product = true; // Để chỉ lưu phí ship cho sản phẩm đầu tiên
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
                // Thêm dữ liệu mới (giống order_now)
                $order_detail_data['original_price'] = $cart->product_price * $cart->quantity; // Giá sản phẩm gốc
                // Chỉ lưu phí ship cho sản phẩm đầu tiên để tránh cộng nhiều lần
                $order_detail_data['shipping_cost'] = $is_first_product ? $shipping_cost : 0;
                
                // Tính coupon_discount cho từng sản phẩm dựa trên tỷ lệ
                $product_total = $cart->product_price * $cart->quantity;
                $product_coupon_discount = 0;
                if ($coupon_discount > 0) {
                    // Tính tỷ lệ giảm giá cho sản phẩm này
                    $product_ratio = $product_total / $base_price;
                    $product_coupon_discount = $coupon_discount * $product_ratio;
                }
                
                $order_detail_data['coupon_discount'] = $product_coupon_discount; // Số tiền giảm giá cho sản phẩm này
                $order_detail_data['product_after_coupon'] = $product_total - $product_coupon_discount; // Giá sản phẩm sau coupon
                
                // Lấy coupon_id nếu có
                $coupon_id = null;
                if ($request->coupon_code != null) {
                    $coupon = DB::table('coupon')->where('coupon_code', $request->coupon_code)->first();
                    if ($coupon) {
                        $coupon_id = $coupon->id;
                    }
                }
                $order_detail_data['coupon_id'] = $coupon_id;
                
                $order_detail_data['created_at'] = now();
                $order_detail_data['updated_at'] = now();
                OrderDetail::insert($order_detail_data);
                
                // Giảm available_stock trong products_combinations
                if ($cart->combination_id) {
                    $combination = DB::table('products_combinations')
                        ->where('id', $cart->combination_id)
                        ->first();
                    
                    if ($combination && $combination->avaiable_stock >= $cart->quantity) {
                        DB::table('products_combinations')
                            ->where('id', $cart->combination_id)
                            ->decrement('avaiable_stock', $cart->quantity);
                    } else {
                        \Log::warning("Không đủ stock trong combination ID: {$cart->combination_id}, Cần: {$cart->quantity}, Có: " . ($combination->avaiable_stock ?? 0));
                    }
                }
                
                // Đặt flag để không lưu phí ship cho các sản phẩm tiếp theo
                $is_first_product = false;
            }
            Cart::where('user_id', $user_id)->where('shop_id', $shop_id)->delete();
            $count_cart = DB::table('cart')
                ->where('user_id', $user_id)
                ->count();
            Session::put('count_cart',$count_cart);
            
            // Tính hoa hồng cho đơn hàng mới (chỉ trên giá sản phẩm, không bao gồm phí ship)
            // Sử dụng giá sản phẩm đã tính lại từ giỏ hàng
            $product_total = $base_price - $coupon_discount; // Giá sản phẩm sau khi trừ coupon
            $this->calculateOrderCommission($order_id, $shop_id, $product_total, 0);
            
            Session::forget('total_price');
            
            return Redirect()-> route('after_order');
        } elseif ($request->payment_option==1) {
            // Thanh toán trực tuyến - chuyển hướng đến trang thanh toán
            // Tính lại tổng tiền từ giỏ hàng để đảm bảo chính xác
            $cart_items = DB::table('cart')
                ->where('user_id', $user_id)
                ->where('shop_id', $shop_id)
                ->get();
            
            $base_price = 0;
            foreach($cart_items as $item) {
                $base_price += $item->product_price * $item->quantity;
            }
            
            // Tính phí ship theo hệ thống mới
            $shipping_cost = $request->shipping_cost ?? 0;
            $coupon_discount = 0;
            
            // Tính coupon_discount
            if ($request->coupon_code != null) {
                $coupon = DB::table('coupon')->where('coupon_code', $request->coupon_code)->first();
                if ($coupon) {
                    if ($coupon->coupon_type == 1) {
                        $coupon_discount = $coupon->coupon_value;
                    } else {
                        $coupon_discount = $base_price * $coupon->coupon_value / 100;
                    }
                }
            }
            
            $total_amount = $base_price + $shipping_cost - $coupon_discount;
            
            // Lưu thông tin đơn hàng vào session để xử lý sau khi thanh toán
            Session::put('pending_order', [
                'shop_id' => $shop_id,
                'ship_name' => $request->ship_name,
                'ship_phonenumber' => $request->ship_phonenumber,
                'ship_email' => $ship_email,
                'ship_address' => $ship_address,
                'note' => $note,
                'total_amount' => $total_amount,
                'shipping_cost' => $shipping_cost,
                'coupon_discount' => $coupon_discount,
                'coupon_code' => $request->coupon_code,
                'payment_method' => 1
            ]);
            
            return redirect()->route('online_payment', ['total' => $total_amount]);
        }
        
    }
    public function buy_now_ajax(){
        $user_id = Session::get('user_id');
        $data = request()->all();
        $shop_id = $data['shop_id'];
      
        $shop = DB::table('shop')
            ->where('id', $shop_id)
            ->select( 'id', 'shopname', 'shopImg', 'latitude', 'longitude', 'address')
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
        
        // Kiểm tra nếu shop là null, redirect về trang trước
        if (!$shop) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin shop. Vui lòng thử lại.');
        }
        
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
            // Tính tổng tiền cuối cùng
            $base_price = Session::get('total_price_now'); // Giá sản phẩm
            $shipping_cost = $request->shipping_cost ?? 0; // Phí ship từ form
            $coupon_discount = 0; // Giảm giá coupon
            
            // Nếu có coupon, lấy giá trị từ session
            if (Session::has('total_price_now_')) {
                $total_amount = Session::get('total_price_now_');
                // Lấy coupon_discount trực tiếp từ coupon
                if ($request->coupon_code != null) {
                    $coupon = DB::table('coupon')->where('coupon_code', $request->coupon_code)->first();
                    if ($coupon) {
                        if ($coupon->coupon_type == 1) {
                            // Type 1: Giảm số tiền cố định
                            $coupon_discount = $coupon->coupon_value;
                        } else {
                            // Type 2: Giảm theo phần trăm
                            $coupon_discount = $base_price * $coupon->coupon_value / 100;
                        }
                    }
                }
            } else {
                // Nếu không có coupon, tính tổng = giá sản phẩm + phí ship
                $total_amount = $base_price + $shipping_cost;
                $coupon_discount = 0;
            }
            
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
                'total_price' => $total_amount,
                'ship_status' => "0",
            );
            $shipping_id = Shipping::insertGetId($shipping_data);

            // insert order
            $order_data = array();
            $order_data['user_id'] = $user_id;
            $order_data['shop_id'] = $shop_id;
            $order_data['payment_id'] = $payment_id;
            $order_data['shipping_id'] = $shipping_id;
            $order_data['order_total'] = $total_amount;
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
            
            // Thêm dữ liệu mới
            $order_detail_data['original_price'] = $base_price; // Giá sản phẩm gốc
            $order_detail_data['shipping_cost'] = $shipping_cost; // Phí ship
            $order_detail_data['coupon_discount'] = $coupon_discount; // Số tiền giảm giá
            $order_detail_data['product_after_coupon'] = $base_price - $coupon_discount; // Giá sản phẩm sau coupon
            
            // Lấy coupon_id nếu có
            $coupon_id = null;
            if ($request->coupon_code != null) {
                $coupon = DB::table('coupon')->where('coupon_code', $request->coupon_code)->first();
                if ($coupon) {
                    $coupon_id = $coupon->id;
                }
            }
            $order_detail_data['coupon_id'] = $coupon_id;
            
            $order_detail_data['created_at'] = now();
            $order_detail_data['updated_at'] = now();
            OrderDetail::insert($order_detail_data);

            // Giảm available_stock trong products_combinations cho checkout trực tiếp
            if ($request->combination_id) {
                $combination = DB::table('products_combinations')
                    ->where('id', $request->combination_id)
                    ->first();
                
                if ($combination && $combination->avaiable_stock >= $request->quantity) {
                    DB::table('products_combinations')
                        ->where('id', $request->combination_id)
                        ->decrement('avaiable_stock', $request->quantity);
                } else {
                    \Log::warning("Không đủ stock trong combination ID: {$request->combination_id}, Cần: {$request->quantity}, Có: " . ($combination->avaiable_stock ?? 0));
                }
            }
            
            $count_cart = DB::table('cart')
                ->where('user_id', $user_id)
                ->count();
            Session::put('count_cart',$count_cart);
            
            // Tính hoa hồng cho đơn hàng mới (chỉ trên giá sản phẩm, không bao gồm phí ship)
            // Nếu có coupon, lấy giá sau khi trừ coupon; nếu không có, lấy giá gốc
            if (Session::has('total_price_before_shipping_now')) {
                $product_total = Session::get('total_price_before_shipping_now');
            } else {
                $product_total = $base_price; // Giá sản phẩm gốc
            }
            $this->calculateOrderCommission($order_id, $shop_id, $product_total, 0);
            
            Session::forget('total_price_now_');
            Session::forget('total_price_now');
            Session::forget('product_buy');
            Session::forget('quantity_now');
            Session::forget('combination_now');
            Session::forget('shop_now');
            Session::forget('combination_id_now');
            return Redirect()-> route('after_order');
        } elseif ($request->payment_option==1) {
            // Thanh toán trực tuyến cho buy now
            $base_price = Session::get('total_price_now');
            $shipping_cost = $request->shipping_cost ?? 0;
            $coupon_discount = 0;
            
            // Tính coupon_discount
            if ($request->coupon_code != null) {
                $coupon = DB::table('coupon')->where('coupon_code', $request->coupon_code)->first();
                if ($coupon) {
                    if ($coupon->coupon_type == 1) {
                        $coupon_discount = $coupon->coupon_value;
                    } else {
                        $coupon_discount = $base_price * $coupon->coupon_value / 100;
                    }
                }
            }
            
            $total_amount = $base_price + $shipping_cost - $coupon_discount;
            
            // Lưu thông tin đơn hàng vào session để xử lý sau khi thanh toán
            Session::put('pending_order_now', [
                'shop_id' => $shop_id,
                'product_id' => $request->product_id,
                'product_name' => $request->productName,
                'product_price' => $request->price,
                'product_quantity' => $request->quantity,
                'combination_id' => $request->combination_id,
                'combination' => $request->combination,
                'ship_name' => $request->ship_name,
                'ship_phonenumber' => $request->ship_phonenumber,
                'ship_email' => $ship_email,
                'ship_address' => $ship_address,
                'note' => $note,
                'total_amount' => $total_amount,
                'shipping_cost' => $shipping_cost,
                'coupon_discount' => $coupon_discount,
                'coupon_code' => $request->coupon_code,
                'payment_method' => 1,
                'is_buy_now' => true
            ]);
            
            return redirect()->route('online_payment', ['total' => $total_amount]);
        }
    }
    public function after_order(Request $request){
        // Kiểm tra nếu có order_id trong session (từ thanh toán online)
        $pendingOrderId = Session::get('pending_payment_order_id');
        
        if ($pendingOrderId) {
            // Kiểm tra trạng thái đơn hàng
            $order = DB::table('orders')->where('id', $pendingOrderId)->first();
            
            if ($order && $order->order_status == 0) {
                // Đơn hàng vẫn ở trạng thái chờ thanh toán
                // Có thể người dùng đã hủy giao dịch hoặc quay lại
                // Tự động hủy đơn hàng sau 5 phút nếu chưa thanh toán
                $orderTime = strtotime($order->created_at);
                $currentTime = time();
                $timeDiff = $currentTime - $orderTime;
                
                // Nếu đơn hàng đã tạo hơn 5 phút và vẫn chưa thanh toán thì hủy
                if ($timeDiff > 300) { // 300 giây = 5 phút
                    DB::table('orders')
                        ->where('id', $pendingOrderId)
                        ->update(['order_status' => 2]); // Hủy đơn hàng
                        
                    Session::forget('pending_payment_order_id');
                    
                    return view('user.after_order')->with('info', 'Đơn hàng đã được hủy do không thanh toán trong thời gian quy định.');
                }
            }
            
            // Xóa session sau khi xử lý
            Session::forget('pending_payment_order_id');
        }
        
        return view('user.after_order');
    }
    
    /**
     * Xử lý khi người dùng quay lại từ trang thanh toán
     */
    public function cancelPaymentOrder(Request $request)
    {
        $pendingOrderId = Session::get('pending_payment_order_id');
        
        if ($pendingOrderId) {
            // Hủy đơn hàng ngay lập tức
            DB::table('orders')
                ->where('id', $pendingOrderId)
                ->update(['order_status' => 2]); // Hủy đơn hàng
                
            Session::forget('pending_payment_order_id');
            
            return redirect()->route('after_order')->with('info', 'Bạn đã hủy giao dịch thanh toán. Đơn hàng đã được hủy.');
        }
        
        return redirect()->route('after_order');
    }
    public function review_order(){
        $user_id = Session::get('user_id');
        $order = DB::table('orders')
            ->where('user_id', $user_id)
            ->select('orders.*', 'shop.shopname')
            ->get();
        return view('user.order_history', compact('order'));
    }
    public function user_purchase(Request $request){
        $user_id = Session::get('user_id');
        $status = $request->get('status', 'all'); // Default to 'all'
        
        // Build query with optional status filter
        $query = DB::table('orders')
            ->join('shop', 'shop.id', '=', 'orders.shop_id')
            ->where('orders.user_id', $user_id);
        
        // Apply status filter
        if ($status !== 'all') {
            switch ($status) {
                case 'pending':
                    $query->where('orders.order_status', 0); // Chờ xác nhận
                    break;
                case 'shipping':
                    $query->where('orders.order_status', 3); // Đang vận chuyển
                    break;
                case 'delivering':
                    $query->where('orders.order_status', 4); // Đang giao
                    break;
                case 'completed':
                    $query->where('orders.order_status', 5); // Hoàn thành
                    break;
                case 'cancelled':
                    $query->where('orders.order_status', 2); // Đã hủy
                    break;
            }
        }
        
        $orders = $query->select('orders.id','orders.shop_id','orders.user_id','orders.order_status','orders.order_total','orders.created_at','shop.shopname','shop.shopImg')
            ->orderBy('orders.id', 'desc')
            ->get();
        
        // Get all order IDs for batch query
        $order_ids = $orders->pluck('id')->toArray();
        
        // Optimized query: Get all order products in one query
        $order_products = collect();
        if (!empty($order_ids)) {
            $order_products = DB::table('order_detail')
                ->join('products', 'products.id', '=', 'order_detail.product_id')
                ->whereIn('order_detail.order_id', $order_ids)
                ->where('order_detail.user_id', $user_id)
                ->select('order_detail.*', 'order_detail.order_id', 'products.id as product_id', 'products.previewImage')
                ->get()
                ->groupBy('order_id');
        }
        
        // Attach products to orders and calculate accurate total
        foreach($orders as $order) {
            $order->order_product = $order_products->get($order->id, collect());
            
            // Tính lại tổng tiền chính xác từ order_detail
            $orderDetails = DB::table('order_detail')->where('order_id', $order->id)->get();
            $accurate_total = 0;
            $shipping_cost = 0;
            
            foreach ($orderDetails as $detail) {
                // Tính giá sản phẩm (không bao gồm shipping)
                if ($detail->product_after_coupon !== null && $detail->product_after_coupon > 0) {
                    $accurate_total += $detail->product_after_coupon;
                } else {
                    // Fallback: tính từ product_price * quantity - coupon_discount
                    $product_total = $detail->product_price * $detail->product_quantity;
                    $coupon_discount = $detail->coupon_discount ?? 0;
                    $accurate_total += $product_total - $coupon_discount;
                }
                
                // Lấy shipping_cost (chỉ lấy 1 lần)
                if ($detail->shipping_cost !== null && $detail->shipping_cost > 0 && $shipping_cost == 0) {
                    $shipping_cost = $detail->shipping_cost;
                }
            }
            
            // Cộng shipping_cost vào tổng tiền (chỉ cộng 1 lần)
            $accurate_total += $shipping_cost;
            
            // Cập nhật order_total với giá trị chính xác
            $order->order_total = $accurate_total;
        }
        
        return view('user.purchase', compact('orders', 'status'));
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
            ->join('products','products.id', '=', 'order_detail.product_id')
            ->where('order_detail.user_id', $user_id)
            ->where('order_detail.order_id', $id)
            ->select('order_detail.*','products.id as product_id','products.previewImage')
            ->get();
        
        // Tính lại tổng tiền chính xác từ order_detail
        $accurate_total = 0;
        $shipping_cost = 0;
        
        foreach ($order_product as $detail) {
            // Tính giá sản phẩm (không bao gồm shipping)
            if ($detail->product_after_coupon !== null && $detail->product_after_coupon > 0) {
                $accurate_total += $detail->product_after_coupon;
            } else {
                // Fallback: tính từ product_price * quantity - coupon_discount
                $product_total = $detail->product_price * $detail->product_quantity;
                $coupon_discount = $detail->coupon_discount ?? 0;
                $accurate_total += $product_total - $coupon_discount;
            }
            
            // Lấy shipping_cost (chỉ lấy 1 lần)
            if ($detail->shipping_cost !== null && $detail->shipping_cost > 0 && $shipping_cost == 0) {
                $shipping_cost = $detail->shipping_cost;
            }
        }
        
        // Cộng shipping_cost vào tổng tiền (chỉ cộng 1 lần)
        $accurate_total += $shipping_cost;
        
        // Cập nhật order_total với giá trị chính xác
        $order->order_total = $accurate_total;
        
        return view('user.purchase_detail', compact('order','order_product'));
    }
    
    public function reorder(Request $request)
    {
        $user_id = Session::get('user_id');
        $order_id = $request->input('order_id');
        
        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng đăng nhập để mua lại'
            ]);
        }
        
        // Get order details
        $order = DB::table('orders')
            ->where('id', $order_id)
            ->where('user_id', $user_id)
            ->first();
            
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ]);
        }
        
        // Get order products
        $order_products = DB::table('order_detail')
            ->where('order_id', $order_id)
            ->where('user_id', $user_id)
            ->get();
            
        if ($order_products->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy sản phẩm trong đơn hàng'
            ]);
        }
        
        // Clear existing cart items for this shop first
        DB::table('cart')
            ->where('user_id', $user_id)
            ->where('shop_id', $order->shop_id)
            ->delete();
        
        $added_count = 0;
        $failed_products = [];
        
        foreach ($order_products as $order_product) {
            // Check if product still exists and is available
            $product = DB::table('products')
                ->where('id', $order_product->product_id)
                ->where('status', 1)
                ->first();
                
            if (!$product) {
                $failed_products[] = $order_product->product_name . ' (Sản phẩm không còn tồn tại)';
                continue;
            }
            
            // Check stock availability
            $available_stock = DB::table('products_combinations')
                ->where('product_id', $order_product->product_id)
                ->where('combination_string', $order_product->product_combination)
                ->sum('avaiable_stock');
                
            if ($available_stock < $order_product->product_quantity) {
                $failed_products[] = $order_product->product_name . ' (Không đủ hàng)';
                continue;
            }
            
            // Add item to cart
            DB::table('cart')->insert([
                'user_id' => $user_id,
                'shop_id' => $order->shop_id,
                'product_id' => $order_product->product_id,
                'productName' => $order_product->product_name,
                'product_price' => $order_product->product_price,
                'combination' => $order_product->product_combination,
                'quantity' => $order_product->product_quantity,
                'product_image' => $order_product->previewImage ?? '',
                'avaiable_stock' => $available_stock,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $added_count++;
        }
        
        if ($added_count > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng',
                'redirect_url' => route('checkout', ['choice-shop' => $order->shop_id])
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không thể mua lại đơn hàng này. ' . implode(', ', $failed_products)
            ]);
        }
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
                Storage::disk('public')->delete($user_img);
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
        $shipping_cost = request('shipping_cost', 30000); // Mặc định 30000 nếu không có
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
                $total_price_display = number_format($total_price+$shipping_cost, 0, ',', '.');
                // Lưu giá sản phẩm (sau khi trừ coupon) và tổng tiền (bao gồm phí ship)
                Session::put('total_price_before_shipping_now', $total_price);
                Session::put('total_price_now_',$total_price+$shipping_cost);
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
                $total_price_display = number_format($total_price+$shipping_cost, 0, ',', '.');
                // Lưu giá sản phẩm (sau khi trừ coupon) và tổng tiền (bao gồm phí ship)
                Session::put('total_price_before_shipping_now', $total_price);
                Session::put('total_price_now_',$total_price+$shipping_cost);
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
        $shipping_cost = request('shipping_cost', 30000); // Mặc định 30000 nếu không có
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
                $total_price_display = number_format($total_price+$shipping_cost, 0, ',', '.');
                // Lưu giá sản phẩm (sau khi trừ coupon) và tổng tiền (bao gồm phí ship)
                Session::put('total_price_before_shipping', $total_price);
                Session::put('total_price',$total_price+$shipping_cost);
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
                $total_price_display = number_format($total_price+$shipping_cost, 0, ',', '.');
                // Lưu giá sản phẩm (sau khi trừ coupon) và tổng tiền (bao gồm phí ship)
                Session::put('total_price_before_shipping', $total_price);
                Session::put('total_price',$total_price+$shipping_cost);
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

    /**
     * Hiển thị trang thanh toán trực tuyến
     */
    public function onlinePayment(Request $request)
    {
        $total = $request->get('total', 0);
        $pendingOrder = Session::get('pending_order');
        $pendingOrderNow = Session::get('pending_order_now');
        
        // Kiểm tra xem có thông tin đơn hàng nào không
        if (!$pendingOrder && !$pendingOrderNow) {
            return redirect()->route('checkout')->with('error', 'Không tìm thấy thông tin đơn hàng');
        }
        
        // Ưu tiên pending_order_now (buy now) nếu có
        $orderData = $pendingOrderNow ?: $pendingOrder;
        
        // Tính lại phí ship theo hệ thống mới nếu cần
        if (isset($orderData['ship_address']) && isset($orderData['shop_id'])) {
            try {
                $shippingService = new ShippingCalculationService();
                $customerCoords = $shippingService->getCoordinatesFromAddress($orderData['ship_address']);
                
                if ($customerCoords) {
                    $shippingInfo = $shippingService->getShippingInfo(
                        $orderData['shop_id'],
                        $orderData['ship_address'],
                        $customerCoords['lat'],
                        $customerCoords['lng']
                    );
                    
                    // Cập nhật phí ship mới
                    $orderData['shipping_cost'] = $shippingInfo['shipping_cost'];
                    
                    // Tính lại tổng tiền
                    $base_price = $orderData['total_amount'] - $orderData['shipping_cost'] + ($orderData['coupon_discount'] ?? 0);
                    $orderData['total_amount'] = $base_price + $orderData['shipping_cost'] - ($orderData['coupon_discount'] ?? 0);
                    $total = $orderData['total_amount'];
                }
            } catch (\Exception $e) {
                \Log::error('Error recalculating shipping in online payment: ' . $e->getMessage());
            }
        }
        
        return view('user.online_payment', compact('total', 'pendingOrder', 'pendingOrderNow', 'orderData'));
    }
    
    /**
     * Xử lý thanh toán Momo
     */
    public function processMomoPayment(Request $request)
    {
        $pendingOrder = Session::get('pending_order');
        $pendingOrderNow = Session::get('pending_order_now');
        
        // Ưu tiên pending_order_now (buy now) nếu có
        $orderData = $pendingOrderNow ?: $pendingOrder;
        
        if (!$orderData) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin đơn hàng'
            ]);
        }
        
        // Tạo đơn hàng sử dụng helper method
        $order_id = $this->createOnlineOrder($orderData);
        
        // Lưu order_id vào session để xử lý sau khi thanh toán thành công
        Session::put('pending_payment_order_id', $order_id);
        
        // Tạo URL thanh toán Momo
        $momoUrl = $this->createMomoPaymentUrl($order_id, $orderData['total_amount']);
        
        if ($momoUrl) {
            return response()->json([
                'status' => true,
                'message' => 'Đơn hàng đã được tạo, chuyển hướng đến thanh toán',
                'payment_url' => $momoUrl,
                'order_id' => $order_id
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi tạo URL thanh toán MoMo. Vui lòng thử lại.'
            ]);
        }
    }
    
    /**
     * Xử lý thanh toán VNPay
     */
    public function processVnpayPayment(Request $request)
    {
        $pendingOrder = Session::get('pending_order');
        $pendingOrderNow = Session::get('pending_order_now');
        
        // Ưu tiên pending_order_now (buy now) nếu có
        $orderData = $pendingOrderNow ?: $pendingOrder;
        
        if (!$orderData) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin đơn hàng'
            ]);
        }
        
        // Tạo đơn hàng sử dụng helper method
        $order_id = $this->createOnlineOrder($orderData);
        
        // Lưu order_id vào session để xử lý sau khi thanh toán thành công
        Session::put('pending_payment_order_id', $order_id);
        
        // Tạo URL thanh toán VNPay (giả lập)
        $vnpayUrl = $this->createVnpayPaymentUrl($order_id, $orderData['total_amount']);
        
        return response()->json([
            'status' => true,
            'message' => 'Đơn hàng đã được tạo, chuyển hướng đến thanh toán',
            'payment_url' => $vnpayUrl,
            'order_id' => $order_id
        ]);
    }
    
    /**
     * Tạo URL thanh toán Momo
     */
    private function createMomoPaymentUrl($orderId, $amount)
    {
        $config = config('momo');
        $environment = $config['environment'];
        $endpoint = $config['endpoint'][$environment];
        
        $partnerCode = $config['partner_code'];
        $accessKey = $config['access_key'];
        $secretKey = $config['secret_key'];
        $orderInfo = "Thanh toán đơn hàng #{$orderId}";
        $orderId = $orderId . "_" . time();
        // Sử dụng domain thực thay vì localhost
        $redirectUrl = url('/after_order');
        $ipnUrl = url('/momo-callback');
        $extraData = "";
        
        $requestId = time() . "";
        $requestType = $config['request_type'];
        
        // Tạo signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => $config['partner_name'],
            "storeId" => $config['store_id'],
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => $config['lang'],
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        
        if (isset($jsonResult['payUrl'])) {
            return $jsonResult['payUrl'];
        } else {
            // Fallback nếu có lỗi
            \Log::error('Momo payment error: ' . $result);
            return null;
        }
    }
    
    /**
     * Gửi POST request đến MoMo API
     */
    private function execPostRequest($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, config('momo.timeout', 30));
        
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            \Log::error('Curl error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }
        
        curl_close($ch);
        return $result;
    }
    
    /**
     * Tạo URL thanh toán VNPay
     */
    private function createVnpayPaymentUrl($orderId, $amount)
    {
        $config = config('vnpay');
        $environment = $config['environment'];
        $vnp_Url = $config['url'][$environment];
        $vnp_Returnurl = url('http://127.0.0.1:8000/vnpay-callback');
        $vnp_TmnCode = $config['tmn_code'];
        $vnp_HashSecret = $config['hash_secret'];

        $vnp_TxnRef = $orderId . "_" . time(); // Mã đơn hàng
        $vnp_OrderInfo = 'Thanh toán đơn hàng #' . $orderId;
        $vnp_OrderType = $config['order_type'];
        $vnp_Amount = $amount * 100; // VNPay yêu cầu amount tính bằng xu
        $vnp_Locale = $config['locale'];
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => $config['version'],
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => $config['command'],
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => $config['curr_code'],
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        // Sắp xếp mảng theo key
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }
    
    /**
     * Xử lý callback từ Momo
     */
    public function momoCallback(Request $request)
    {
        // Debug logging - log tất cả callback data
        \Log::info("MoMo callback received", [
            'all_params' => $request->all(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        $partnerCode = $request->get('partnerCode');
        $orderId = $request->get('orderId');
        $requestId = $request->get('requestId');
        $amount = $request->get('amount');
        $orderInfo = $request->get('orderInfo');
        $orderType = $request->get('orderType');
        $transId = $request->get('transId');
        $resultCode = $request->get('resultCode');
        $message = $request->get('message');
        $payType = $request->get('payType');
        $responseTime = $request->get('responseTime');
        $extraData = $request->get('extraData');
        $signature = $request->get('signature');
        
        // Xác thực signature
        $config = config('momo');
        $accessKey = $config['access_key'];
        $secretKey = $config['secret_key'];
        
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime . "&resultCode=" . $resultCode . "&transId=" . $transId;
        $checkSignature = hash_hmac("sha256", $rawHash, $secretKey);
        
        if ($signature === $checkSignature) {
            // Lấy order_id thực từ orderId (bỏ phần timestamp)
            $realOrderId = explode('_', $orderId)[0];
            \Log::info("MoMo signature valid for order: {$realOrderId}, resultCode: {$resultCode}");
            
            if ($resultCode == 0) {
                // Thanh toán thành công
                DB::table('payment')
                    ->where('id', function($query) use ($realOrderId) {
                        $query->select('payment_id')
                              ->from('orders')
                              ->where('id', $realOrderId);
                    })
                    ->update([
                        'payment_status' => '1',
                        'transaction_id' => $transId,
                        'updated_at' => now()
                    ]);
                
                DB::table('orders')
                    ->where('id', $realOrderId)
                    ->update(['order_status' => '1']); // Đã thanh toán
                    
                \Log::info("Momo payment success for order: {$realOrderId}, transId: {$transId}");
                return redirect()->route('after_order')->with('success', 'Thanh toán thành công!');
            } else {
                // Xử lý các trường hợp thất bại khác nhau
                if ($resultCode == 1006) {
                    // Người dùng hủy giao dịch
                    DB::table('orders')
                        ->where('id', $realOrderId)
                        ->update(['order_status' => '2']); // Hủy đơn hàng
                        
                    \Log::info("Momo payment cancelled by user for order: {$realOrderId}");
                    return redirect()->route('after_order')->with('info', 'Bạn đã hủy giao dịch thanh toán.');
                } else {
                    // Thanh toán thất bại do lỗi khác
                    DB::table('orders')
                        ->where('id', $realOrderId)
                        ->update(['order_status' => '0']); // Chờ thanh toán
                        
                    \Log::warning("Momo payment failed for order: {$realOrderId}, resultCode: {$resultCode}, message: {$message}");
                    return redirect()->route('after_order')->with('error', 'Thanh toán thất bại: ' . $message);
                }
            }
        } else {
            // Signature không hợp lệ
            \Log::error("MoMo callback signature invalid for order: {$orderId}. Expected: {$checkSignature}, Received: {$signature}");
            return redirect()->route('after_order')->with('error', 'Lỗi xác thực thanh toán!');
        }
    }
    
    /**
     * Xử lý callback từ VNPay
     */
    public function vnpayCallback(Request $request)
    {
        $vnp_TmnCode = $request->get('vnp_TmnCode');
        $vnp_Amount = $request->get('vnp_Amount');
        $vnp_BankCode = $request->get('vnp_BankCode');
        $vnp_BankTranNo = $request->get('vnp_BankTranNo');
        $vnp_CardType = $request->get('vnp_CardType');
        $vnp_OrderInfo = $request->get('vnp_OrderInfo');
        $vnp_PayDate = $request->get('vnp_PayDate');
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $vnp_TransactionStatus = $request->get('vnp_TransactionStatus');
        
        // Xác thực signature
        $config = config('vnpay');
        $vnp_HashSecret = $config['hash_secret'];
        
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
        if ($secureHash == $vnp_SecureHash) {
            // Lấy order_id thực từ vnp_TxnRef (bỏ phần timestamp)
            $realOrderId = explode('_', $vnp_TxnRef)[0];
            
            if ($vnp_ResponseCode == '00' && $vnp_TransactionStatus == '00') {
                // Thanh toán thành công
                DB::table('payment')
                    ->where('id', function($query) use ($realOrderId) {
                        $query->select('payment_id')
                              ->from('orders')
                              ->where('id', $realOrderId);
                    })
                    ->update([
                        'payment_status' => '1',
                        'transaction_id' => $vnp_BankTranNo,
                        'updated_at' => now()
                    ]);
                
                DB::table('orders')
                    ->where('id', $realOrderId)
                    ->update(['order_status' => '1']); // Đã thanh toán
                    
                \Log::info("VNPay payment success for order: {$realOrderId}, BankTranNo: {$vnp_BankTranNo}");
                return redirect()->route('after_order')->with('success', 'Thanh toán thành công!');
            } else {
                // Xử lý các trường hợp thất bại khác nhau
                if ($vnp_ResponseCode == '24' || $vnp_TransactionStatus == '24') {
                    // Người dùng hủy giao dịch
                    DB::table('orders')
                        ->where('id', $realOrderId)
                        ->update(['order_status' => '2']); // Hủy đơn hàng
                        
                    \Log::info("VNPay payment cancelled by user for order: {$realOrderId}");
                    return redirect()->route('after_order')->with('info', 'Bạn đã hủy giao dịch thanh toán.');
                } else {
                    // Thanh toán thất bại do lỗi khác
                    DB::table('orders')
                        ->where('id', $realOrderId)
                        ->update(['order_status' => '0']); // Chờ thanh toán
                        
                    \Log::warning("VNPay payment failed for order: {$realOrderId}, ResponseCode: {$vnp_ResponseCode}, TransactionStatus: {$vnp_TransactionStatus}");
                    return redirect()->route('after_order')->with('error', 'Thanh toán thất bại!');
                }
            }
        } else {
            // Signature không hợp lệ
            \Log::error("VNPay callback signature invalid for order: {$vnp_TxnRef}");
            return redirect()->route('after_order')->with('error', 'Lỗi xác thực thanh toán!');
        }
    }

    /**
     * Tạo đơn hàng cho thanh toán trực tuyến
     */
    private function createOnlineOrder($orderData)
    {
        $user_id = Session::get('user_id');
        $shop_id = $orderData['shop_id'];
        
        // Insert payment method
        $payment_data = array();
        $payment_data['payment_method'] = 1; // Thanh toán trực tuyến
        $payment_data['shop_id'] = $shop_id;
        $payment_data['user_id'] = $user_id;
        $payment_data['payment_status'] = "0"; // Chưa thanh toán
        $payment_id = Payment::insertGetId($payment_data);
        
        // Insert shipping
        $shipping_data = array(
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'ship_name' => $orderData['ship_name'],
            'ship_phonenumber' => $orderData['ship_phonenumber'],
            'ship_email' => $orderData['ship_email'],
            'ship_address' => $orderData['ship_address'],
            'note' => $orderData['note'],
            'total_price' => $orderData['total_amount'],
            'ship_status' => "0",
        );
        $shipping_id = Shipping::insertGetId($shipping_data);
        
        // Insert order
        $order_data = array();
        $order_data['user_id'] = $user_id;
        $order_data['shop_id'] = $shop_id;
        $order_data['payment_id'] = $payment_id;
        $order_data['shipping_id'] = $shipping_id;
        $order_data['order_total'] = $orderData['total_amount'];
        $order_data['order_status'] = "0"; // Chờ thanh toán
        $order_data['created_at'] = now();
        $order_data['updated_at'] = now();
        $order_id = Order::insertGetId($order_data);
        
        // Xử lý order detail dựa trên loại đơn hàng
        if (isset($orderData['is_buy_now']) && $orderData['is_buy_now']) {
            // Buy now - insert từ thông tin sản phẩm
            $order_detail_data = array();
            $order_detail_data['order_id'] = $order_id;
            $order_detail_data['product_id'] = $orderData['product_id'];
            $order_detail_data['shop_id'] = $shop_id;
            $order_detail_data['user_id'] = $user_id;
            $order_detail_data['product_name'] = $orderData['product_name'];
            $order_detail_data['product_price'] = $orderData['product_price'];
            $order_detail_data['product_quantity'] = $orderData['product_quantity'];
            $order_detail_data['combination_id'] = $orderData['combination_id'];
            $order_detail_data['product_combination'] = $orderData['combination'] ?? "";
            $order_detail_data['original_price'] = $orderData['product_price'] * $orderData['product_quantity'];
            $order_detail_data['shipping_cost'] = $orderData['shipping_cost'];
            $order_detail_data['coupon_discount'] = $orderData['coupon_discount'];
            $order_detail_data['product_after_coupon'] = ($orderData['product_price'] * $orderData['product_quantity']) - $orderData['coupon_discount'];
            
            // Lấy coupon_id nếu có
            $coupon_id = null;
            if ($orderData['coupon_code'] != null) {
                $coupon = DB::table('coupon')->where('coupon_code', $orderData['coupon_code'])->first();
                if ($coupon) {
                    $coupon_id = $coupon->id;
                }
            }
            $order_detail_data['coupon_id'] = $coupon_id;
            $order_detail_data['created_at'] = now();
            $order_detail_data['updated_at'] = now();
            OrderDetail::insert($order_detail_data);
            
            // Giảm stock cho buy now
            if ($orderData['combination_id']) {
                $combination = DB::table('products_combinations')
                    ->where('id', $orderData['combination_id'])
                    ->first();
                
                if ($combination && $combination->avaiable_stock >= $orderData['product_quantity']) {
                    DB::table('products_combinations')
                        ->where('id', $orderData['combination_id'])
                        ->decrement('avaiable_stock', $orderData['product_quantity']);
                }
            }
        } else {
            // Checkout thường - insert từ cart
            $cart = Cart::where('user_id', $user_id)->where('shop_id', $shop_id)->get();
            $is_first_product = true; // Để chỉ lưu phí ship cho sản phẩm đầu tiên
            foreach($cart as $key => $cartItem){
                $order_detail_data = array();
                $order_detail_data['order_id'] = $order_id;
                $order_detail_data['product_id'] = $cartItem->product_id;
                $order_detail_data['shop_id'] = $shop_id;
                $order_detail_data['user_id'] = $user_id;
                $order_detail_data['product_name'] = $cartItem->productName;
                $order_detail_data['product_price'] = $cartItem->product_price;
                $order_detail_data['product_quantity'] = $cartItem->quantity;
                $order_detail_data['combination_id'] = $cartItem->combination_id;
                $order_detail_data['product_combination'] = $cartItem->combination ?? "";
                $order_detail_data['original_price'] = $cartItem->product_price * $cartItem->quantity;
                // Chỉ lưu phí ship cho sản phẩm đầu tiên để tránh cộng nhiều lần
                $order_detail_data['shipping_cost'] = $is_first_product ? $orderData['shipping_cost'] : 0;
                
                // Tính coupon_discount cho từng sản phẩm dựa trên tỷ lệ
                $product_total = $cartItem->product_price * $cartItem->quantity;
                $product_coupon_discount = 0;
                if ($orderData['coupon_discount'] > 0) {
                    // Tính tỷ lệ giảm giá cho sản phẩm này
                    $total_product_price = 0;
                    foreach($cart as $item) {
                        $total_product_price += $item->product_price * $item->quantity;
                    }
                    $product_ratio = $product_total / $total_product_price;
                    $product_coupon_discount = $orderData['coupon_discount'] * $product_ratio;
                }
                
                $order_detail_data['coupon_discount'] = $product_coupon_discount;
                $order_detail_data['product_after_coupon'] = $product_total - $product_coupon_discount;
                
                // Lấy coupon_id nếu có
                $coupon_id = null;
                if ($orderData['coupon_code'] != null) {
                    $coupon = DB::table('coupon')->where('coupon_code', $orderData['coupon_code'])->first();
                    if ($coupon) {
                        $coupon_id = $coupon->id;
                    }
                }
                $order_detail_data['coupon_id'] = $coupon_id;
                $order_detail_data['created_at'] = now();
                $order_detail_data['updated_at'] = now();
                OrderDetail::insert($order_detail_data);
                
                // Đặt flag để không lưu phí ship cho các sản phẩm tiếp theo
                $is_first_product = false;
            }
            
            // Giảm stock cho cart
            foreach($cart as $cartItem) {
                if ($cartItem->combination_id) {
                    $combination = DB::table('products_combinations')
                        ->where('id', $cartItem->combination_id)
                        ->first();
                    
                    if ($combination && $combination->avaiable_stock >= $cartItem->quantity) {
                        DB::table('products_combinations')
                            ->where('id', $cartItem->combination_id)
                            ->decrement('avaiable_stock', $cartItem->quantity);
                    }
                }
            }
            
            // Xóa cart
            Cart::where('user_id', $user_id)->where('shop_id', $shop_id)->delete();
            $count_cart = DB::table('cart')->where('user_id', $user_id)->count();
            Session::put('count_cart', $count_cart);
        }
        
        // Giảm coupon amount nếu có
        if ($orderData['coupon_code'] != null) {
            DB::table('coupon')
                ->where('coupon_code', $orderData['coupon_code'])
                ->update(['coupon_amount' => DB::raw('coupon_amount - 1')]);
        }
        
        // Tính hoa hồng - sử dụng giá sản phẩm thực tế từ orderData
        $product_total = $orderData['total_amount'] - $orderData['shipping_cost']; // Giá sản phẩm không bao gồm phí ship
        $this->calculateOrderCommission($order_id, $shop_id, $product_total, 0);
        
        // Xóa session
        Session::forget('total_price');
        Session::forget('total_price_now');
        Session::forget('pending_order');
        Session::forget('pending_order_now');
        Session::forget('product_buy');
        Session::forget('quantity_now');
        Session::forget('combination_now');
        Session::forget('shop_now');
        Session::forget('combination_id_now');
        
        return $order_id;
    }

    /**
     * Tính hoa hồng cho đơn hàng mới
     */
    private function calculateOrderCommission($orderId, $shopId, $orderTotal, $status)
    {
        $syncService = new CommissionSyncService();
        return $syncService->calculateOrderCommission($orderId, $shopId, $orderTotal, $status);
    }

}