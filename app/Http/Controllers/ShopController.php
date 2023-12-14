<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
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
session_start();
class ShopController extends Controller
{
    public function index_shop(){
        $shop_id = Session::get('shop_id');
        $total_order = DB::table('orders')->where('shop_id',$shop_id)->count();        
        // dd($total_order);
        $total_sale = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->sum('order_total');
        $pending_order = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'0')
            ->count();
        $accept_order = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
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
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-01-01')))
            ->sum('order_total');
        $earning_month_2 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-02-01')))
            ->sum('order_total');
        $earning_month_3 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-03-01')))
            ->sum('order_total');
        $earning_month_4 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-04-01')))
            ->sum('order_total');
        $earning_month_5 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-05-01')))
            ->sum('order_total');
        $earning_month_6 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-06-01')))
            ->sum('order_total');
        $earning_month_7 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-07-01')))
            ->sum('order_total');
        $earning_month_8 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-08-01')))
            ->sum('order_total');
        $earning_month_9 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-09-01')))
            ->sum('order_total');
        $earning_month_10 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-10-01')))
            ->sum('order_total');
        $earning_month_11 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-11-01')))
            ->sum('order_total');
        $earning_month_12 = DB::table('orders')
            ->where('shop_id',$shop_id)
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-12-01')))
            ->sum('order_total');
      return view('shop.index',compact('total_order','total_sale','pending_order','accept_order','earning_month_1','earning_month_2','earning_month_3','earning_month_4','earning_month_5','earning_month_6','earning_month_7','earning_month_8','earning_month_9','earning_month_10','earning_month_11','earning_month_12'));
        
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
            'description' => request('description'),
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
    public function manage_order(){
        $shop_id = Session::get('shop_id');
        $order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('payment', 'payment.id', '=', 'orders.payment_id')
            ->where('orders.shop_id', $shop_id)
            ->where('orders.order_status', '!=', '2')
            ->select('orders.id','orders.updated_at','orders.order_status','orders.order_total','users.firstname','users.lastname','payment.payment_method','payment.payment_status')
            ->orderBy('orders.id', 'desc')
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
        $order = DB::table('orders')
            ->where('id', $order_id)
            ->update(['order_status' => 2]);
        return response()->json([
            'status' => true
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
        // dd($order_detail);
        return view('shop.view_order_detail',compact('order_detail','ship_info'));
    }
    public function manage_order_cancel(){
        $shop_id = Session::get('shop_id');
        $order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('payment', 'payment.id', '=', 'orders.payment_id')
            ->where('orders.shop_id', $shop_id)
            ->where('orders.order_status', '=', '2')
            ->select('orders.id','orders.updated_at','orders.created_at','orders.order_status','orders.order_total','users.firstname','users.lastname','payment.payment_method','payment.payment_status')
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
        $shop_id = Session::get('shop_id');
        $shop_img= DB::table('shop')
            ->select('shopImg')
            ->where('id', $shop_id)
            ->first();
        // dd($shop_img);
        $email_all= DB::table('shop')
            ->select('email')
            ->where('id', '!=', $shop_id)
            ->get();
        $email = $request->email;
        foreach($email_all as $key => $value){
            if($email == $value->email){
                return redirect()->route('shop_profile')->with('error','Email đã tồn tại');
            }
        }
        $shop_name_all= DB::table('shop')
            ->select('shopname')
            ->where('id', '!=', $shop_id)
            ->get();
        $shop_name= $request->shopname;
        foreach($shop_name_all as $key => $value){
            if($shop_name == $value->shopname){
                return redirect()->route('shop_profile')->with('error','Tên shop đã tồn tại');
            }
        }
        $data = array();
        $data['shopname'] = $request->shopname;
        $data['email'] = $request->email;
        $data['updated_at'] = now();
        if(request()->hasFile('shop_img')){
            $file = request()->file('shop_img')->store('logo_shop','public');
            if($shop_img != null){
                unlink('storage/'.$shop_img->shopImg);
            }
            $data['shopImg'] = $file;
            Session::put('shopImg',$file);
        }
        Session::put('shop_name',$request->shopname);
        DB::table('shop')->where('id',$shop_id)->update($data);
        return redirect()->route('shop_profile')->with('message','Cập nhật thông tin thành công');
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
}
 