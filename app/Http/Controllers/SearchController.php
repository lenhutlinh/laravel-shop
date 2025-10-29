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

class SearchController extends Controller
{
    public function search_products(){
        $keyword = request()->keyword;
        $products = Products::where('productName', 'like', $keyword . '%')
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('id', 'asc')
            ->where('products.status', 1)
            ->paginate(30);
        return  view('user.search')->with(compact('products', 'keyword'));
    }
    public function price_arround(){
        $data = request()->all();
        $keyword = $data['keyword'];
        $price_from = $data['price_from'];
        $price_to = $data['price_to'];
        if ($price_from == 0 && $price_to == 0) {
            return response()->json([
                'message' => 'Giá bắt đầu và giá kết thúc không được để trống',
                'status' => false
            ]);
        }
        if ($price_from == '') {
            $price_from = 0;
        }
        if ($price_to == '') {
            $price_to = max(Products::pluck('price')->toArray());
        }
        if($price_from > $price_to){
            return response()->json([
                'message' => 'Giá bắt đầu phải nhỏ hơn giá kết thúc',
                'status' => false
            ]);
        }
        $products = Products::whereBetween('price', [$price_from, $price_to])
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->where('products.status', 1)
            ->where('productName', 'like', $keyword . '%')
            ->orderBy('price', 'asc')
            ->paginate(30);
        $html = view('user.ajax_search',compact('products','price_from','price_to','keyword'))->render();
        return response()->json ([
            'status' => true,
            'html' => $html,
        ]);
    }
    public function search_choose_popular(){
        $data = request()->all();
        $keyword = $data['keyword'];
        $arrange = $data['arrange'];
        if(isset($data['price_from'] )){
            $price_from = $data['price_from'];
            $price_to = $data['price_to'];
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->whereBetween('price', [$price_from, $price_to])
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'asc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange','price_from','price_to'))->render();
            return response()->json (['html' => $html]);
        }else{
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'asc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function search_choose_newest(){
        $data = request()->all();
        $keyword = $data['keyword'];
        $arrange = $data['arrange'];

        if(isset($data['price_from'] )){
            $price_from = $data['price_from'];
            $price_to = $data['price_to'];    
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->whereBetween('price', [$price_from, $price_to])
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                 ->orderBy('id', 'desc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange','price_from','price_to'))->render();
            return response()->json (['html' => $html]);
        }else{
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'desc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function search_choose_best_sell(){
        $data = request()->all();
        $keyword = $data['keyword'];
        $arrange = $data['arrange'];

        if(isset($data['price_from'])){
            $price_from = $data['price_from'];
            $price_to = $data['price_to'];
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->whereBetween('price', [$price_from, $price_to])
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('sales_quantity', 'desc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange','price_from','price_to'))->render();
            return response()->json (['html' => $html]);
            
        }else{
            
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('sales_quantity', 'desc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange'))->render();
            return response()->json (['html' => $html]);
        }

    }
    public function search_choose_high_low(){
        $data = request()->all();
        $keyword = $data['keyword'];
        $arrange = $data['arrange'];
        
        
        if(isset($data['price_from'])){
            $price_from = $data['price_from'];
            $price_to = $data['price_to'];
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->whereBetween('price', [$price_from, $price_to])
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'desc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange','price_from','price_to'))->render();
            return response()->json (['html' => $html]);
        }else{

            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'desc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function search_choose_low_high(){
        $data = request()->all();
        $keyword = $data['keyword'];
        $arrange = $data['arrange'];
        if(isset($data['price_from'])){
            $price_from = $data['price_from'];
            $price_to = $data['price_to'];
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->whereBetween('price', [$price_from, $price_to])
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'asc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange','price_from','price_to'))->render();
            return response()->json (['html' => $html]);
        }else{
            $products = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('productName', 'like', '%' . $keyword . '%')
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'asc')
                ->paginate(30);
            $html = view('user.ajax_search',compact('products','keyword','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function category_products($categoryName){
        $category = Categories::where('categoryName', $categoryName)->first();
        $category_info = DB::table('categories')
        ->where('categoryName', $categoryName)
        ->select('categories.id', 'categories.categoryName')
        ->first();
        $sub_category = SubCategories::where('category_id', $category->id)->get();
        $products = Products::where('category_id', $category->id)
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('id', 'asc')
            ->where('products.status', 1)
            ->paginate(30);
        // dd($category_info);
        return  view('user.category_products')->with(compact('products', 'category','sub_category','category_info'));
    }
    public function category_choose_subcategory(){
        $data = request()->all();
        $category_id = $data['category_id'];
        $subcategory_id = $data['subcategory_id'];
        
        $product_shop = DB::table('products')
            ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
            ->where('products.category_id', $data['category_id'])
            ->where('subcategory_id', $data['subcategory_id'])
            ->where('products.status', 1)
            ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
            ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
            ->orderBy('id', 'asc')
            ->paginate(30);
        $html = view('user.ajax_shop',compact('product_shop','category_id','subcategory_id'))->render();
        return response()->json (['html' => $html]);
    }
    public function category_choose_popular(){
        $data = request()->all();
        $category_id = $data['category_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
        
    public function category_choose_newest(){
        $data = request()->all();
        $category_id = $data['category_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('id', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function category_choose_best_sell(){
        $data = request()->all();
        $category_id = $data['category_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('sales_quantity', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('sales_quantity', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }

    }
    public function category_choose_high_low(){
        $data = request()->all();
        $category_id = $data['category_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'desc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
    public function category_choose_low_high(){
        $data = request()->all();
        $category_id = $data['category_id'];
        $arrange = $data['arrange'];
        if(isset($data['subcategory_id'])){
            $subcategory_id = $data['subcategory_id'];
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->where('subcategory_id', $subcategory_id)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange','subcategory_id'))->render();
            return response()->json (['html' => $html]);
        }else{
            $product_shop = DB::table('products')
                ->leftjoin('order_detail', 'order_detail.product_id', '=', 'products.id')
                ->where('products.category_id', $data['category_id'])
                ->where('products.status', 1)
                ->select('products.id', 'products.productName', 'products.price', 'products.previewImage',DB::raw('SUM(order_detail.product_quantity) as sales_quantity'))
                ->groupBy('products.id','products.price', 'products.productName', 'products.previewImage')
                ->orderBy('products.price', 'asc')
                ->paginate(30);
            $html = view('user.ajax_shop',compact('product_shop','category_id','arrange'))->render();
            return response()->json (['html' => $html]);
        }
    }
}
