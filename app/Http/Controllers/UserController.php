<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\ProductsImages;
use App\Models\ProductCombination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;

class UserController extends Controller
{
    public function index()
    {
        Session::forget('product_id');
        $category = Categories::select('id', 'categoryName','categoryIcon')->get();
        $products = DB::table('products')
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->where('products.status', '=', 1)
            ->join('shop', 'products.shop_id', '=', 'shop.id')
            ->where('shop.status', '=', 1)
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('id', 'desc')-> paginate(54);
        // dd($category);
        return view('index', compact('products','category'));
    }
    public function detail_product($product_id)
    {
        $products = DB::table('products')
            ->where('id', $product_id)->first();
        if($products->status != 1){
            return redirect()->back()->with('error', 'Sản phẩm đã ngừng kinh doanh');
        }
        $products_images = DB::table('products_images')
            ->where('product_id', $product_id)
            ->select('products_images.imageProduct')
            ->get();
        $shop = DB::table('shop')
            ->where('id', $products->shop_id)
            ->select('shop.id', 'shop.shopname','shop.shopImg','shop.email','shop.status')
            ->first();
        if($shop->status != 1){
            return redirect()->back()->with('error', 'Cửa hàng đã ngừng kinh doanh');
        }
        $product_count = DB::table('products')
            ->where('shop_id', $shop->id)
            ->count();
        
        $join_date = DB::table('shop')
            ->where('id', $shop->id)
            ->select('created_at')
            ->first();
        $created_at = now()->diffInDays($join_date->created_at);
        $var_option= DB::table('products_variations_options')
            ->where('product_id', $product_id)
            ->select('products_variations_options.variationName')
            ->get();
            
        $product_sale = DB::table('products')
            ->join('order_detail', 'products.id', '=', 'order_detail.product_id', )
            ->where('products.id', $product_id)
            ->select(DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->first();
        $combination_string = DB::table('products_combinations')
            ->where('product_id', $product_id)
            ->select('products_combinations.combination_string', 'products_combinations.avaiable_stock', 'products_combinations.id','products_combinations.product_id')
            ->get();
        
        $sum_avaialbe = DB::table('products_combinations')
            ->where('product_id', $product_id)
            ->sum('avaiable_stock');
        Session::put('product_id', $product_id);
        $category = DB::table('categories')->where('id', $products->category_id)->first();
        $subcategory = DB::table('subcategories')->where('id', $products->subcategory_id)->first();
        // dd($sum_avaialbe);

        return view('detail_product', compact('products', 'products_images', 'shop', 'var_option', 'combination_string', 'sum_avaialbe', 'product_count', 'created_at','product_sale','category','subcategory'));

    }
    public function add_cart_ajax(Request $request){
        $user_id = Session::get('user_id');
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $product_id = Session::get('product_id');
        $cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->where('product_id', $data['id_'])
            ->where('combination', $data['combination'])
            ->first();
            
        if ($data['quantity'] > $data['avaiable_stock']) {
            return response()->json([
                'message' => 'Số lượng sản phẩm trong kho không đủ',
                'status' => false
            ]);
        }
        if($data['avaiable_stock'] <= 0){
            return response()->json([
                'message' => 'Sản phẩm đã hết hàng. ',
                'status' => false,
            ]);
        }
        if($data['quantity'] <= 0){
            return response()->json([
                'message' => 'Số lượng không thể nhỏ hơn hoặc bằng 0. ',
                'status' => false,
            ]);
        }
        if(isset($cart)){
            $quantity = $cart->quantity;
            $quantity = $quantity + $data['quantity'];
            if($quantity > $data['avaiable_stock']){
                return response()->json([
                    'message' => 'Bạn đã có ' . $cart->quantity . ' sản phẩm trong giỏ hàng. 
                    Không thể thêm số lượng đã chọn vào giỏ hàng vì sẽ vượt quá số lượng sản phẩm trong kho.',
                    'status' => false,
                ]);
            }else{
                // $cart[$key]['quantity'] = $quantity;
                Cart::where('user_id', $user_id)
                    ->where('product_id', $data['id_'])
                    ->where('combination', $data['combination'])
                    ->update(['quantity' => $quantity]);
            }
        }else{
            $cart[] =array(
                'product_id' => $data['id_'],
                'user_id' => $user_id,
                'shop_id' => $data['shop_id'],
                'productName' => $data['productName'],
                'product_price' => $data['price'],
                'product_image' => $data['previewImage'],
                'quantity' => $data['quantity'],
                'avaiable_stock' => $data['avaiable_stock'],
                'combination' => $data['combination'],
                'combination_id' => $data['combination_id'],
            );
            DB::table('cart')->insert($cart);
        }
        
        $count_cart = DB::table('cart')
            ->where('user_id', $user_id)
            ->count();
        Session::put('count_cart',$count_cart);
        Session::save();

        return response()->json([
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
            'status' => true,
            'count_cart' => $count_cart
        ]);
    }
    public function show_cart_ajax(){
        $user_id = Session::get('user_id');
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
        // dd($shop_sum);
        return view('user.cart', compact('shop_sum', 'product_cart'));
    }
    public function view_shop($shop_id){
        $shop_info = DB::table('shop')
            ->where('id', $shop_id)
            ->select('shop.id', 'shop.shopname','shop.shopImg','shop.email','shop.status')
            ->first();
        if ($shop_info->status != 1) {
            return redirect()->back()->with('error', 'Cửa hàng đã ngừng kinh doanh');
        }
        $product_count = DB::table('products')
            ->where('shop_id', $shop_id)
            ->count();
        $join_date = DB::table('shop')
            ->where('id', $shop_id)
            ->select('created_at')
            ->first();
        // $created_at = $join_date->created_at;
        // $created_at = date('d/m/Y', strtotime($created_at));
        $created_at = now()->diffInDays($join_date->created_at);
        $shop_category = DB::table('products')
            ->where('products.shop_id', $shop_id)
            ->select( 'subcategory_id', 'subCategoryName')
            ->groupBy('subcategory_id', 'subCategoryName')
            ->get();
        $product_shop = DB::table('products') 
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->where('products.shop_id', $shop_id)
            ->where('products.status', 1)
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('id', 'asc')
            ->paginate(30);
        $product_top_sale = OrderDetail::take(6)
            ->join('products', 'order_detail.product_id', '=', 'products.id')
            ->where('products.shop_id', $shop_id)
            ->where('products.status', 1)
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage', DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('sales_quantity', 'desc')
            ->get();
        // dd($shop_category);
        return view('user.shop',compact('shop_info', 'product_count', 'created_at', 'shop_category', 'product_shop', 'product_top_sale'));
    }
    public function choose_subcategory(){
        $data = request()->all();
        $shop_id = $data['shop_id'];
        $subcategory_id = $data['subcategory_id'];
        
        $product_shop = DB::table('products')
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->where('products.shop_id', $data['shop_id'])
            ->where('subcategory_id', $data['subcategory_id'])
            ->where('products.status', 1)
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('id', 'asc')
            ->paginate(30);
        $html = view('user.ajax_shop',compact('product_shop','shop_id','subcategory_id'))->render();
        return response()->json (['html' => $html]);
    }
    public function choose_popular(){
        $data = request()->all();
        $shop_id = $data['shop_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function choose_newest(){
        $data = request()->all();
        $shop_id = $data['shop_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function choose_best_sell(){
        $data = request()->all();
        $shop_id = $data['shop_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('sales_quantity', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('sales_quantity', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }

    }
    public function choose_high_low(){
        $data = request()->all();
        $shop_id = $data['shop_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function choose_low_high(){
        $data = request()->all();
        $shop_id = $data['shop_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.shop_id', $data['shop_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','shop_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function user_cancel_order(Request $request){
        $user_id = Session::get('user_id');
        $order_id = $request->order_id;
        $order = DB::table('orders')
            ->where('id', $order_id)
            ->where('user_id', $user_id)
            ->update(['order_status' => 2]);
        return response()->json([
            'status' => true
        ]);
    }
    
} 
