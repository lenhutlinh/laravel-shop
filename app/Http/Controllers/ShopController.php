<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ProductsImages;
use App\Models\ProductCombination;
use App\Models\CommissionRate;
use App\Services\CommissionSyncService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Session;
class ShopController extends Controller
{
    public function index_shop(){
        $shop_id = Session::get('shop_id');
        
        // Sử dụng CommissionSyncService để tự động đồng bộ
        $syncService = new CommissionSyncService();
        $syncService->syncShopCommission($shop_id);
        
        // Đếm tổng đơn hàng (tất cả trạng thái trừ hủy)
        $total_order = DB::table('orders')
            ->where('shop_id', $shop_id)
            ->whereIn('order_status', [0, 1, 3, 4, 5])
            ->count();
            
        // Tổng doanh thu từ tất cả trạng thái (xác nhận, vận chuyển, giao hàng, hoàn thành)
        $total_sale = (int) DB::table('orders')
            ->where('shop_id', $shop_id)
            ->whereIn('order_status', [1, 3, 4, 5])
            ->sum('order_total');
            
        // Đơn hàng chờ xử lý (status = 0)
        $pending_order = DB::table('orders')
            ->where('shop_id', $shop_id)
            ->where("order_status", '0')
            ->count();
            
        // Đơn hàng đã xác nhận (status = 1)
        $accept_order = DB::table('orders')
            ->where('shop_id', $shop_id)
            ->where("order_status", '1')
            ->count();

        $updated_at = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->where('orders.id', 12)
            ->select('updated_at')
            ->get();
        $date_month = date('m');
        // foreach($updated_at as $key => $value){
        //     dd(date('m',strtotime($value->updated_at)));
        // }
        // dd($updated_at->updated_at);
        // dd(date('m',strtotime($updated_at->updated_at)));
        // $month_11= date('m',strtotime('2023-11-01'));
        // dd($month_11);
        $earning_month_1 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-01-01')))
            ->sum('order_total');
        $earning_month_2 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-02-01')))
            ->sum('order_total');
        $earning_month_3 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-03-01')))
            ->sum('order_total');
        $earning_month_4 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-04-01')))
            ->sum('order_total');
        $earning_month_5 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-05-01')))
            ->sum('order_total');
        $earning_month_6 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-06-01')))
            ->sum('order_total');
        $earning_month_7 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-07-01')))
            ->sum('order_total');
        $earning_month_8 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-08-01')))
            ->sum('order_total');
        $earning_month_9 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-09-01')))
            ->sum('order_total');
        $earning_month_10 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-10-01')))
            ->sum('order_total');
        $earning_month_11 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-11-01')))
            ->sum('order_total');
        $earning_month_12 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'5')
            ->whereMonth('updated_at', date('m',strtotime('2025-12-01')))
            ->sum('order_total');
        // Tính thực nhận (sau khi trừ hoa hồng từ đơn hàng hoàn thành)
        $commissionRate = CommissionRate::where('shop_id', $shop_id)->first();
        if ($commissionRate) {
            $total_commission = $commissionRate->total_commission;
            $paid_commission = $commissionRate->paid_commission; // Hoa hồng đã thu từ đơn hoàn thành
            
            // Tính thực nhận đúng: cộng tất cả "Shop nhận" từ đơn hàng hoàn thành
            // Logic giống như trong manage_order: shop_revenue = net_price - commission_amount
            $completed_orders = DB::table('orders')
                ->where('shop_id', $shop_id)
                ->where("order_status", '5')
                ->get();
            
            $actual_earning = 0;
            foreach ($completed_orders as $order) {
                // Lấy order_detail
                $orderDetail = DB::table('order_detail')->where('order_id', $order->id)->first();
                
                if ($orderDetail) {
                    $product_price = $orderDetail->product_price * $orderDetail->product_quantity;
                    $coupon_discount = $orderDetail->coupon_discount ?? 0;
                    
                    // Tính shop_revenue giống như trong manage_order
                    $net_price = $product_price - $coupon_discount;
                    $commission_rate = 0.04; // 4%
                    $commission_amount = $net_price * $commission_rate;
                    $shop_revenue = $net_price - $commission_amount;
                    
                    // Cộng vào tổng thực nhận
                    $actual_earning += $shop_revenue;
                }
            }
        } else {
            $total_commission = 0;
            $paid_commission = 0;
            $actual_earning = 0;
        }
        
      return view('shop.index',compact('total_order','total_sale','actual_earning','total_commission','pending_order','accept_order','earning_month_1','earning_month_2','earning_month_3','earning_month_4','earning_month_5','earning_month_6','earning_month_7','earning_month_8','earning_month_9','earning_month_10','earning_month_11','earning_month_12'));
        
    }
    public function add_product(){
        $category= DB::table('categories')->orderby('id','desc')->get();
        return view('shop.add_product')->with(compact('category'));

    }
    public function select_category(Request $request){
        $data = $request->category_id;
        $subcategory = DB::table('subcategories')->where('category_id',$data)->get();
        return response()->json($subcategory);
    }
    public function shop_add_products(){ 
        #insert products
        $shop_id = Session::get('shop_id');
        $category_id = request('category');
        $subcategory_id = request('subcategory');
        $category = DB::table('categories')->where('id',$category_id)->first();
        $subcategory = DB::table('subcategories')->where('id',$subcategory_id)->first();
        $products = array(
            'shop_id' => $shop_id,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'productName' =>request('product_name'),
            'price' => request('product_price'),
            'description' => request('description') ?: '',
            'categoryName' => $category->categoryName,
            'subCategoryName' => $subcategory->subCategoryName,
            'status' => 1,
        );
        
        Session::put('products',$products);
        #insert product_variations
        $product_variation_option=request('variation_option');

        if (isset($product_variation_option)) {
            Session::put('variation_name', $product_variation_option);
            $product_combination= array();
            $product_variation_option_value= request('variation_option_name');    
            $product_variation_option_value1= request('variation_option_name1');
            $product_variation_option_value2= request('variation_option_name2');
            $product_variation_option_value3= request('variation_option_name3');
            if(isset($product_variation_option_value)){
                $product_combination[]= $product_variation_option_value;
                Session::put('variation_option', $product_variation_option_value);
            }
            if(isset($product_variation_option_value1)){
                $product_combination[]= $product_variation_option_value1;
                Session::put('variation_option1', $product_variation_option_value1);
            }
            if(isset($product_variation_option_value2)){
                $product_combination[]= $product_variation_option_value2;
                Session::put('variation_option2', $product_variation_option_value2);
            }
            if(isset($product_variation_option_value3)){
                $product_combination[]= $product_variation_option_value3;
                Session::put('variation_option3', $product_variation_option_value3);
            }
            
        }
        
        #insert product_variations 2
        $product_variations_options= request('variations_options');
        
        if(isset($product_variations_options)){
            Session::put('variations_name', $product_variations_options);
            $product_combinations= array();
            $product_variations_options_value= request('variations_options_name');
            $product_variations_options_value1= request('variations_options_name1');
            $product_variations_options_value2= request('variations_options_name2');
            $product_variations_options_value3= request('variations_options_name3');
            if(isset($product_variations_options_value)){
                $product_combinations[]= $product_variations_options_value;
                Session::put('variations_option', $product_variations_options_value);
            }
            if(isset($product_variations_options_value1)){
                $product_combinations[]= $product_variations_options_value1;
                Session::put('variations_option1', $product_variations_options_value1);       
            }
            if(isset($product_variations_options_value2)){
                $product_combinations[]= $product_variations_options_value2;
                Session::put('variations_option2', $product_variations_options_value2);
            }
            if(isset($product_variations_options_value3)){ 
                $product_combinations[]= $product_variations_options_value3;
                Session::put('variations_option3', $product_variations_options_value3);
            }
            
        } 
        if(isset($product_combination) && isset($product_combinations)){
            $i = $product_combination;
            $j = $product_combinations;
            foreach($i as $key => $value){
                foreach($j as $key1 => $value1){
                    $product_combination_string = $value.' '.$value1;
                    $combination_string[] = $product_combination_string;
                }
            }
            Session::put('combination_string', $combination_string);
            return redirect() ->route('add_product_quantity');
        }
        if(isset($product_combination) && !isset($product_combinations)){
            $combination_string = array();
            $i = $product_combination;
            foreach($i as $key => $value){
                $combination_string[] = $value;
            }
            Session::put('combination_string', $combination_string);
            return redirect() ->route('add_product_quantity');
        }
        if(isset($product_combinations) && !isset($product_combination)){
            $j = $product_combinations;
            $combination_string = array();
            foreach($j as $key1 => $value1){
                $combination_string[] = $value1;
            }
            Session::put('combination_string', $combination_string);
            return redirect() ->route('add_product_quantity');
        }
        else{
            $combination_string[]= '';
            Session::put('combination_string', $combination_string);
            return redirect() ->route('add_product_quantity');
            
        }
        
    }
    public function add_product_quantity (){
        return view('shop.add_product_quantity');
    }
    public function add_product_quantitys(Request $request){
        $products = Session::get('products');
        
        // Debug: Log session data
        \Log::info('Session products data:', ['products' => $products]);
        
        // Check if products data exists in session
        if (!$products || !is_array($products)) {
            \Log::error('Products session data is missing or invalid', ['products' => $products]);
            return redirect()->back()->with('error', 'Không tìm thấy thông tin sản phẩm. Vui lòng thử lại.');
        }
        
        $product_id= DB::table('products')->insertGetId($products);
        
        #insert product_image
        $product_image = array(
            'product_id' => $product_id,
            'imageProduct' => $request->product_img,
        );
       
        $product_image1 = array(
            'product_id' => $product_id,
            'imageProduct' => $request->product_img1,
        );
        
        
        $product_image2 = array(
            'product_id' => $product_id,
            'imageProduct' => $request->product_img2,
        );
        $product_image3 = array(
            'product_id' => $product_id,
            'imageProduct' => $request->product_img3,
        );
        $product_image4 = array(
            'product_id' => $product_id,
            'imageProduct' => $request->product_img4,
        );
        
        if(isset($product_image['imageProduct'])){
            $images =$request->validate([
                'product_img' => 'required',
            ]);
            $image_id = new ProductsImages();
            $image_id ->product_id = $product_id;
            if($request->hasFile('product_img')){
                $product_images = $request->file('product_img')->store('images_product','public');
                $image_id->imageProduct = $product_images;
                DB::table('products')->where('id',$product_id)->update(['previewImage' => $product_images]);     
            }
            $image_id->save();
        }
        if(isset($product_image1['imageProduct'])){
            $images1 =$request->validate([
                'product_img1' => 'required',
            ]);
            $image_id1 = new ProductsImages();
            $image_id1 ->product_id = $product_id;
            if($request->hasFile('product_img1')){
                $product_images1 = $request->file('product_img1')->store('images_product','public');
                $image_id1->imageProduct = $product_images1;     
            }
            $image_id1->save();
        }
        if(isset($product_image2['imageProduct'])){
            $images2 =$request->validate([
                'product_img2' => 'required',
            ]);
            $image_id2 = new ProductsImages();
            $image_id2 ->product_id = $product_id;
            if($request->hasFile('product_img2')){
                $product_images2 = $request->file('product_img2')->store('images_product','public');
                $image_id2->imageProduct = $product_images2;     
            }
            $image_id2->save();
        }
        if(isset($product_image3['imageProduct'])){
            $images3 =$request->validate([
                'product_img3' => 'required',
            ]);
            $image_id3 = new ProductsImages();
            $image_id3 ->product_id = $product_id;
            if($request->hasFile('product_img3')){
                $product_images3 = $request->file('product_img3')->store('images_product','public');
                $image_id3->imageProduct = $product_images3;     
            }
            $image_id3->save();
        }
        if(isset($product_image4['imageProduct'])){
            $images4 =$request->validate([
                'product_img4' => 'required',
            ]);
            $image_id4 = new ProductsImages();
            $image_id4 ->product_id = $product_id;
            if($request->hasFile('product_img4')){
                $product_images4 = $request->file('product_img4')->store('images_product','public');
                $image_id4->imageProduct = $product_images4;     
            }
            $image_id4->save();
        }
        #insert product variation
        $varation_name = array(
            'product_id' => $product_id,
            'variationName' => Session::get('variation_name'),
        );
        if(isset($varation_name['variationName'])) {
            $varation_name_id= DB::table('products_variations_options')->insertGetId($varation_name);
            $product_variation_option= array(
                'products_variation_id' => $varation_name_id,
                'variationName' => Session::get('variation_option'),
            );
            $product_variation_option1= array(
                'products_variation_id' => $varation_name_id,
                'variationName' => Session::get('variation_option1'),
            );
            $product_variation_option2= array(
                'products_variation_id' => $varation_name_id,
                'variationName' => Session::get('variation_option2'),
            );
            $product_variation_option3= array(
                'products_variation_id' => $varation_name_id,
                'variationName' => Session::get('variation_option3'),
            );
            $product_combination= array();
            if(isset($product_variation_option['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($product_variation_option);
            }
            if(isset($product_variation_option1['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($product_variation_option1);
            }
            
            if(isset($product_variation_option2['variationName'])){
               DB::table('products_variations_options_value')->insertGetId($product_variation_option2);
            }
            if(isset($product_variation_option3['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($product_variation_option3);
            }
        }
        $varations_names = array(
            'product_id' => $product_id,
            'variationName' => Session::get('variations_name'),
        );
        if(isset($varations_names['variationName'])) {
            $varations_names_id= DB::table('products_variations_options')->insertGetId($varations_names);
            $products_variations_option= array(
                'products_variation_id' => $varations_names_id,
                'variationName' => Session::get('variations_option'),
            );
            $products_variations_option1= array(
                'products_variation_id' => $varations_names_id,
                'variationName' => Session::get('variations_option1'),
            );
            $products_variations_option2= array(
                'products_variation_id' => $varations_names_id,
                'variationName' => Session::get('variations_option2'),
            );
            $products_variations_option3= array(
                'products_variation_id' => $varations_names_id,
                'variationName' => Session::get('variations_option3'),
            );
            if(isset($products_variations_option['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($products_variations_option);
            }
            if(isset($products_variations_option1['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($products_variations_option1);
            }
            
            if(isset($products_variations_option2['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($products_variations_option2);
            }
            if(isset($products_variations_option3['variationName'])){
                DB::table('products_variations_options_value')->insertGetId($products_variations_option3);
            }
        }
        #insert product_combination
        $combination_string = Session::get('combination_string');
        $avaiable_stock=$request->avaiable_stock;
        foreach($avaiable_stock as $key => $value){
            $product_combinations[]= $value;
        }
        foreach($combination_string as $key => $value){
            $product_combination =new ProductCombination();
            $product_combination->product_id = $product_id;
            $product_combination->combination_string = $value;
            $product_combination->avaiable_stock = 0;
            $product_combination->save();
            DB::table('products_combinations')->where('id',$product_combination->id)->update(['avaiable_stock' => $product_combinations[$key]]);
        }
        Session::forget('products');
        Session::forget('variation_name');
        Session::forget('combination_string');
        Session::forget('variation_option');
        Session::forget('variation_option1');
        Session::forget('variation_option2');
        Session::forget('variation_option3');
        Session::forget('variations_name');
        Session::forget('variations_option');
        Session::forget('variations_option1');
        Session::forget('variations_option2');
        Session::forget('variations_option3');
        return redirect()->route('add_product')->with('success','Thêm sản phẩm thành công');
    }
    public function manage_product (){
        $shop_id = Session::get('shop_id');
        $product_shop = DB::table('products') 
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->where('products.shop_id', $shop_id)
            ->select('products.id','products.status', 'products.productName', 'products.price',  'products.subCategoryName', 'products.previewImage' ,DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage','products.status', 'products.subCategoryName')
            ->orderBy('products.id', 'asc')
            ->get();
        $product_stock= DB::table('products_combinations')
            ->join('products', 'products.id', '=', 'products_combinations.product_id')
            ->where('products.shop_id', $shop_id)
            ->select('products_combinations.product_id', DB::raw('SUM(products_combinations.avaiable_stock) as total_stock'))
            ->groupBy('products_combinations.product_id')
            ->get();
        // $sales_quantity = DB::table('products')
        //     ->rightjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
        //     ->leftjoin('orders', 'orders.id', '=', 'order_detail.order_id')
        //     ->where('products.shop_id', $shop_id)
        //     ->where('orders.order_status', 1)
        //     ->select('order_detail.product_id', DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
        //     ->groupBy('order_detail.product_id')
        //     ->get();
        // dd($sales_quantity);
        return view('shop.manage_product',compact('product_shop','product_stock'));
       
    }
    public function stop_product_ajax(Request $request){
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $shop_id = Session::get('shop_id');
        $cart = DB::table('products')
            ->where('shop_id', $shop_id)
            ->where('id', $data['id'])
            ->update(['status' => 0]);
      
        return response()->json([
            'status' => true
        ]);
    }
    public function start_product_ajax(Request $request){
        $data=$request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $shop_id = Session::get('shop_id');
        $cart = DB::table('products')
            ->where('shop_id', $shop_id)
            ->where('id', $data['id'])
            ->update(['status' => 1]);
      
        return response()->json([
            'status' => true
        ]);
    }
    public function edit_product($product_id){
        $shop_id = Session::get('shop_id');
        $product = DB::table('products')
            ->where('shop_id', $shop_id)
            ->where('id', $product_id)
            ->first();
        $combination_string = DB::table('products_combinations')
            ->where('product_id', $product_id)
            ->select('combination_string','avaiable_stock','id','product_id')
            ->get();
        $category = DB::table('categories')
            ->get();
        $subcategory = DB::table('subcategories')
            ->get();
        // dd($product);
        Session::put('combination_string', $combination_string->pluck('combination_string'));
        return view('shop.edit_product',compact('product','combination_string','category','subcategory'));
    }
    public function update_product(Request $request){
        $shop_id = Session::get('shop_id');
        $product_id = $request->product_id;
        $category_id = $request->category;
        $subcategory_id = $request->subcategory;
        $category = DB::table('categories')->where('id',$category_id)->first();
        $subcategory = DB::table('subcategories')->where('id',$subcategory_id)->first();
        $product= array(
            'productName' => $request->product_name,
            'price' => $request->product_price,
            'description' => $request->description,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'categoryName' => $category->categoryName,
            'subCategoryName' => $subcategory->subCategoryName,
            'shop_id' => $shop_id,
        );
        DB::table('products')->where('id',$product_id)->update($product);
        
        // Handle image uploads if provided
        if($request->hasFile('product_img')){
            $images = $request->file('product_img');
            $imageCount = 0;
            
            foreach($images as $index => $image){
                if($imageCount >= 5) break; // Limit to 5 images
                
                // Store the image
                $imagePath = $image->store('images_product','public');
                
                // Create new product image record
                $productImage = new ProductsImages();
                $productImage->product_id = $product_id;
                $productImage->imageProduct = $imagePath;
                $productImage->save();
                
                // Set first image as preview image
                if($index == 0){
                    DB::table('products')->where('id',$product_id)->update(['previewImage' => $imagePath]);
                }
                
                $imageCount++;
            }
        }
        
        $combination_string = Session::get('combination_string');
        $avaiable_stock=$request->avaiable_stock;
        foreach($avaiable_stock as $key => $value){
            $avaiable_stocks[]= $value;
        }
        foreach($combination_string as $key => $value){
            DB::table('products_combinations')
            ->where('combination_string',$value)
            ->update(['avaiable_stock' => $avaiable_stocks[$key]]);
        }
        return redirect()->route('manage_product')->with('success','Cập nhật sản phẩm thành công');
    }
    
    public function delete_preview_image(Request $request){
        $product_id = $request->product_id;
        $product = DB::table('products')->where('id', $product_id)->first();
        
        if(!$product){
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ]);
        }
        
        // Delete preview image file
        if($product->previewImage && file_exists('storage/'.$product->previewImage)){
            unlink('storage/'.$product->previewImage);
        }
        
        // Update product to remove preview image
        DB::table('products')->where('id', $product_id)->update(['previewImage' => null]);
        
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa ảnh chính thành công'
        ]);
    }
    
    public function delete_product_image(Request $request){
        $image_id = $request->image_id;
        $image = DB::table('products_images')->where('id', $image_id)->first();
        
        if(!$image){
            return response()->json([
                'status' => false,
                'message' => 'Ảnh không tồn tại'
            ]);
        }
        
        // Delete image file
        if($image->imageProduct && file_exists('storage/'.$image->imageProduct)){
            unlink('storage/'.$image->imageProduct);
        }
        
        // Delete image record from database
        DB::table('products_images')->where('id', $image_id)->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa ảnh thành công'
        ]);
    }
    public function manage_order(){
        $shop_id = Session::get('shop_id');
        $order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('payment', 'payment.id', '=', 'orders.payment_id')
            ->where('orders.shop_id', $shop_id)
            ->where('orders.order_status', '!=', '2')
            ->select('orders.id','orders.updated_at','orders.order_status','orders.order_total','orders.shipping_id','users.firstname','users.lastname','payment.payment_method','payment.payment_status')
            ->orderBy('orders.order_status', 'asc')  // Sắp xếp theo trạng thái trước (0, 1, 3, 4, 5)
            ->orderBy('orders.id', 'desc')           // Sau đó sắp xếp theo ID giảm dần
            ->get();
        
        $product_order = DB::table('order_detail')
            ->join('products_combinations', 'products_combinations.id', '=', 'order_detail.combination_id')
            ->join('products', 'products.id', '=', 'products_combinations.product_id')
            ->where('order_id', 12)
            ->select('order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','products_combinations.avaiable_stock','products_combinations.id')
            ->groupBy('order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','products_combinations.avaiable_stock','products_combinations.id')
            ->orderBy('order_detail.product_id', 'asc')
            ->get();
        // $product_id_order = DB::table('order_detail')
        //     ->join('products_combinations', 'products_combinations.combination_string', '=', 'order_detail.product_combination')
        //     ->where('order_id', 12)
        //     ->select('order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','products_combinations.avaiable_stock','products_combinations.id')
        //     ->groupBy('order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','products_combinations.avaiable_stock','products_combinations.id')
        //     ->orderBy('order_detail.product_id', 'asc')
        //     ->get();
        // dd($product_order);
        return view('shop.manage_order',compact('order'));
    }
    public function accept_order(Request $request){
        $order_id = $request->order_id;
        
        $product_order = DB::table('order_detail')
        ->join('products_combinations', 'products_combinations.id', '=', 'order_detail.combination_id')
        ->join('products', 'products.id', '=', 'products_combinations.product_id')
        ->where('order_id', $order_id)
        ->select('order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','products_combinations.avaiable_stock','products_combinations.id')
        ->groupBy('order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','products_combinations.avaiable_stock','products_combinations.id')
        ->orderBy('order_detail.product_id', 'asc')
        ->get();
        foreach ($product_order as $key => $value) {
            if ($value->avaiable_stock < $value->product_quantity ) {
                $product = DB::table('products')
                    ->where('id', $value->product_id)
                    ->first();
                return response()->json([
                    'product' => $product->productName,
                    'status' => false
                ]);
            }
        }
        foreach ($product_order as $key => $value) {
            if($value->avaiable_stock >= $value->product_quantity){
                DB::table('products_combinations')
                    ->join('products', 'products.id', '=', 'products_combinations.product_id')
                    ->join('order_detail', 'order_detail.product_id', '=', 'products.id')
                    ->where('products_combinations.product_id',$value->product_id)
                    ->where('combination_string',$value->product_combination)
                    ->update(['avaiable_stock' => DB::raw('avaiable_stock - '.$value->product_quantity)]);
            }
        }
        $order = DB::table('orders')
            ->where('id', $order_id)
            ->update(['order_status' => 1,'updated_at' => now()]);
        return response()->json([
            'status' => true
        ]);
    }
    public function cancel_order(Request $request){
        $order_id = $request->order_id;
        
        // Kiểm tra trạng thái đơn hàng trước khi hủy
        $order = DB::table('orders')->where('id', $order_id)->first();
        
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ]);
        }
        
        // Không cho phép hủy đơn hàng đã hoàn thành (status = 5)
        if ($order->order_status == 5) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể hủy đơn hàng đã hoàn thành'
            ]);
        }
        
        // Không cho phép hủy đơn hàng đã hủy (status = 2)
        if ($order->order_status == 2) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng đã được hủy trước đó'
            ]);
        }
        
        $order = DB::table('orders')
            ->where('id', $order_id)
            ->update(['order_status' => 2]);
        return response()->json([
            'status' => true,
            'message' => 'Hủy đơn hàng thành công'
        ]);
    }
    public function view_order_detail($order_id){
       
        $order_detail = DB::table('order_detail')
            ->join('products', 'products.id', '=', 'order_detail.product_id')
            ->where('order_id', $order_id)
            ->select('order_detail.product_price', 'previewImage', 'order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','order_detail.product_name')
            ->groupBy('order_detail.product_price', 'previewImage','order_detail.product_id','order_detail.product_combination','order_detail.product_quantity','order_detail.product_name')
            ->get();
        $ship_info = DB::table('orders')
            ->join('shipping', 'shipping.id', '=', 'orders.shipping_id')
            ->where('orders.id', $order_id)
            ->select('ship_name','ship_email','ship_address','ship_phonenumber','note')
            ->first();
        $order_status = DB::table('orders')
            ->where('id', $order_id)
            ->value('order_status');
        // dd($order_detail);
        return view('shop.view_order_detail',compact('order_detail','ship_info','order_status','order_id'));
    }
    public function update_order_status(Request $request){
        $shop_id = Session::get('shop_id');
        $order_id = $request->order_id;
        $status = (int)$request->order_status;
        // chỉ cho phép các trạng thái hợp lệ
        if(!in_array($status, [3,4,5])){
            return redirect()->back()->with('error','Trạng thái không hợp lệ');
        }
        // đảm bảo đơn thuộc shop hiện tại
        $order = DB::table('orders')->where('id',$order_id)->where('shop_id',$shop_id)->first();
        if(!$order){
            return redirect()->back()->with('error','Không tìm thấy đơn hàng');
        }
        // Đảm bảo tổng tiền đơn hàng đồng bộ theo chi tiết đơn
        $order_total = DB::table('order_detail')
            ->where('order_id', $order_id)
            ->select(DB::raw('SUM(product_price * product_quantity) as total'))
            ->value('total');
        DB::table('orders')->where('id',$order_id)->update([
            'order_status'=>$status,
            'order_total'=> $order_total ?? 0,
            'updated_at'=>now()
        ]);

        // Tính hoa hồng khi đơn hàng chuyển sang các trạng thái có hoa hồng (status = 1,3,4,5)
        if(in_array($status, [1, 3, 4, 5])) {
            $this->calculateOrderCommission($order_id, $shop_id, $order_total ?? 0, $status);
        }

    return redirect()->back()->with('message','Đã cập nhật thành công');
    }
    public function manage_order_cancel(){
        $shop_id = Session::get('shop_id');
        $order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('payment', 'payment.id', '=', 'orders.payment_id')
            ->where('orders.shop_id', $shop_id)
            ->where('orders.order_status', '=', '2')
            ->select('orders.id','orders.updated_at','orders.created_at','orders.order_status','orders.order_total','orders.shipping_id','users.firstname','users.lastname','payment.payment_method','payment.payment_status')
            ->orderBy('orders.id', 'desc')  // Sắp xếp đơn hủy theo ID giảm dần
            ->get();
        // dd($order);
        return view('shop.manage_order_cancel',compact('order'));
    }
    public function shop_profile(){
        $shop_id = Session::get('shop_id');
        $shop = DB::table('shop')
            ->where('id', $shop_id)
            ->first();
        return view('shop.shop_profile',compact('shop'));
    }
    public function change_profile_shop(Request $request){
        try {
            \Log::info('change_profile_shop called', [
                'request_data' => $request->all(),
                'shop_id' => Session::get('shop_id')
            ]);
            
            $shop_id = Session::get('shop_id');
            
            if (!$shop_id) {
                \Log::error('No shop_id in session');
                return response()->json(['error' => 'Không tìm thấy shop_id'], 400);
            }
            
            $shop_img= DB::table('shop')
                ->select('shopImg')
                ->where('id', $shop_id)
                ->first();
            
            // Kiểm tra email nếu có
            if($request->email) {
                $email_all= DB::table('shop')
                    ->select('email')
                    ->where('id', '!=', $shop_id)
                    ->get();
                $email = $request->email;
                foreach($email_all as $key => $value){
                    if($email == $value->email){
                        return response()->json(['error' => 'Email đã tồn tại'], 400);
                    }
                }
            }
            
            // Kiểm tra tên shop nếu có
            if($request->shopname) {
                $shop_name_all= DB::table('shop')
                    ->select('shopname')
                    ->where('id', '!=', $shop_id)
                    ->get();
                $shop_name= $request->shopname;
                foreach($shop_name_all as $key => $value){
                    if($shop_name == $value->shopname){
                        return response()->json(['error' => 'Tên shop đã tồn tại'], 400);
                    }
                }
            }
            
            $data = array();
            $data['updated_at'] = now();
            
            // Chỉ cập nhật các field có giá trị
            if($request->shopname) {
                $data['shopname'] = $request->shopname;
            }
            if($request->email) {
                $data['email'] = $request->email;
            }
            
            // Cập nhật địa chỉ và tọa độ
            if($request->address) {
                $data['address'] = $request->address;
                \Log::info('Adding address to data', ['address' => $request->address]);
            }
            if($request->latitude) {
                $data['latitude'] = $request->latitude;
                \Log::info('Adding latitude to data', ['latitude' => $request->latitude]);
            }
            if($request->longitude) {
                $data['longitude'] = $request->longitude;
                \Log::info('Adding longitude to data', ['longitude' => $request->longitude]);
            }
            
            if(request()->hasFile('shop_img')){
                $file = request()->file('shop_img')->store('logo_shop','public');
                if ($shop_img && $shop_img->shopImg) {
                    Storage::disk('public')->delete($shop_img->shopImg);
                }
                $data['shopImg'] = $file;
                Session::put('shopImg',$file);
            }
            
            if($request->shopname) {
                Session::put('shop_name',$request->shopname);
            }
            
            \Log::info('Updating shop with data', ['data' => $data]);
            
            $result = DB::table('shop')->where('id',$shop_id)->update($data);
            
            \Log::info('Update result', ['result' => $result]);
            
            return response()->json(['success' => 'Cập nhật thông tin thành công']);
            
        } catch (\Exception $e) {
            \Log::error('Error in change_profile_shop', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
    public function shop_password(){
        return view('shop.shop_password');
    }
    public function change_password_shop(Request $request){
        $shop_id = Session::get('shop_id');
        $shop = DB::table('shop')
            ->where('id', $shop_id)
            ->first();
        $old_password = $shop->password;
        
        if (Hash::check($request->pre_password, $old_password )) {
            $data = array();
            $data['password'] = Hash::make(request('password'));
            $data['updated_at'] = now();
            DB::table('shop')->where('id', $shop_id)->update($data);
            return redirect()->route('shop_password')->with('message','Cập nhật thành công');
        }
        return redirect()->route('shop_password')->with('error','Mật khẩu cũ không đúng');
    }

    /**
     * Tính hoa hồng cho đơn hàng dựa trên trạng thái
     */
    private function calculateOrderCommission($orderId, $shopId, $orderTotal, $status)
    {
        $syncService = new CommissionSyncService();
        return $syncService->calculateOrderCommission($orderId, $shopId, $orderTotal, $status);
    }

    /**
     * Đồng bộ dữ liệu hoa hồng cho một shop cụ thể
     */
    private function syncShopCommissionData($shopId)
    {
        try {
            $orders = DB::table('orders')
                ->where('shop_id', $shopId)
                ->whereIn('order_status', [0, 1, 3, 4, 5])
                ->get();
            
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
                // Tính hoa hồng chính xác (order_total đã là giá gốc)
                $correctCommissionAmount = $order->order_total * 0.04;
                
                $orderCommission = DB::table('order_commissions')
                    ->where('order_id', $order->id)
                    ->first();
                
                if (!$orderCommission) {
                    DB::table('order_commissions')->insert([
                        'order_id' => $order->id,
                        'shop_id' => $shopId,
                        'commission_amount' => $correctCommissionAmount,
                        'status' => $order->order_status == 5 ? 'completed' : 'pending',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    $orderCommission = (object)[
                        'commission_amount' => $correctCommissionAmount,
                        'status' => $order->order_status == 5 ? 'completed' : 'pending'
                    ];
                } else {
                    $needsUpdate = false;
                    $updateData = [];
                    
                    if (abs($orderCommission->commission_amount - $correctCommissionAmount) > 0.01) {
                        $updateData['commission_amount'] = $correctCommissionAmount;
                        $needsUpdate = true;
                    }
                    
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
            
            $commissionRate->update([
                'total_commission' => $totalCommission,
                'pending_commission' => $pendingCommission,
                'paid_commission' => $paidCommission
            ]);
            
        } catch (\Exception $e) {
            \Log::error("Error syncing commission data for shop #{$shopId}: " . $e->getMessage());
        }
    }
}
 