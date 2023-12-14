<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
use App\Models\User;
use App\Models\Coupon;
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
class AdminController extends Controller
{
    public function login_admin()
    {
        if(Session::get('admin_id')){
            return redirect()->route('dashboard_admin');
        }
        return view('admin.login_admin');
    }
    public function logins_admin(Request $request)
    {
        $data = $request->all();
        $admin = User::where('email', $data['email'])->first();
        if ($admin) {
            if (Hash::check($data['password'], $admin->password)) {
                Session::put('admin_id', $admin->id);
                Session:: put('admin_name',$admin->firstname . ' ' . $admin->lastname);
                Session:: put('admin_email',$admin->email);
                Session::put('admin_img', $admin->userImg);
                return redirect()->route('dashboard_admin');
            } else {
                return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
            }
        } else {
            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function dashboard_admin()
    {
        $total_shop = Shop::where('status', 1)->count();
        $total_user = User::where('role_id', 2)->where('status', 1)->count();
        $total_order = DB::table('orders')->where('order_status', 1)->count();
        $total_money = DB::table('orders')->where('order_status', 1)->sum('order_total');
        $earning_month_1 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-01-01')))
            ->sum('order_total');
        $earning_month_2 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-02-01')))
            ->sum('order_total');
        $earning_month_3 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-03-01')))
            ->sum('order_total');
        $earning_month_4 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-04-01')))
            ->sum('order_total');
        $earning_month_5 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-05-01')))
            ->sum('order_total');
        $earning_month_6 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-06-01')))
            ->sum('order_total');
        $earning_month_7 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-07-01')))
            ->sum('order_total');
        $earning_month_8 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-08-01')))
            ->sum('order_total');
        $earning_month_9 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-09-01')))
            ->sum('order_total');
        $earning_month_10 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-10-01')))
            ->sum('order_total');
        $earning_month_11 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-11-01')))
            ->sum('order_total');
        $earning_month_12 = DB::table('orders')
            ->where("order_status",'1')
            ->whereMonth('updated_at', date('m',strtotime('2023-12-01')))
            ->sum('order_total');
        return view('admin.index', compact('total_shop', 'total_user', 'total_order', 'total_money', 'earning_month_1', 'earning_month_2', 'earning_month_3', 'earning_month_4', 'earning_month_5', 'earning_month_6', 'earning_month_7', 'earning_month_8', 'earning_month_9', 'earning_month_10', 'earning_month_11', 'earning_month_12'));
    }
    public function logout_admin()
    {
        Session::forget('admin_id');
        Session::forget('admin_name');
        Session::forget('admin_email');
        Session::forget('admin_img');
        return redirect()->route('login_admin');
    }
    public function manage_shop_regist()
    {
        $shop = Shop::where('status', 0)->get();
        
        return view('admin.manage_shop_regist', compact('shop'));
    }
    public function accept_shop(Request $request)
    {
        $data = $request->all();
        $shop = Shop::find($data['id']);
        $shop->status = 1;
        $shop->save();
        return response()->json([
            'status' => true,
            'message' => 'Duyệt cửa hàng thành công'
        ]);
    }
    public function delete_shop(Request $request)
    {
        $data = $request->all();
        $shop = Shop::find($data['id']);
        $shop->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa cửa hàng thành công'
        ]);
    }
    public function manage_shop_list()
    {
        $shop = Shop::where('status', 1)
        ->leftjoin('orders', 'shop.id', '=', 'orders.shop_id',)
        // ->where('orders.order_status', 1)
        ->select('shop.id','shop.status','shop.shopname','shop.email','shop.shopImg','shop.created_at','shop.updated_at', DB::raw('SUM(orders.order_total) as order_total'))
        ->groupBy('shop.id', 'shop.shopname', 'shop.email', 'shop.shopImg', 'shop.created_at', 'shop.updated_at','shop.status')
        ->get();
        
        return view('admin.manage_shop_list', compact('shop'));
    }
    public function stop_shop(Request $request)
    {
        $data = $request->all();
        $shop = Shop::find($data['id']);
        $shop->status = 2;
        $shop->save();
        return response()->json([
            'status' => true,
            'message' => 'Khóa cửa hàng thành công'
        ]);
    }
    public function manage_shop_stop()
    {
        $shop = Shop::where('status', 2)
        ->leftjoin('orders', 'shop.id', '=', 'orders.shop_id',)
        // ->where('orders.order_status', 1)
        ->select('shop.id','shop.status','shop.shopname','shop.email','shop.shopImg','shop.created_at','shop.updated_at', DB::raw('SUM(orders.order_total) as order_total'))
        ->groupBy('shop.id', 'shop.shopname', 'shop.email', 'shop.shopImg', 'shop.created_at', 'shop.updated_at','shop.status')
        ->get();
        return view('admin.manage_shop_stop', compact('shop'));
    }
    public function manage_shop_edit($shopname)
    {
        $shop = Shop::where('shopname', $shopname)->first();
        // dd($shop);
        return view('admin.manage_shop_edit', compact('shop'));
    }
   public function manage_shop_edits(Request $request)
    {
        $data = $request->all();
        $shop = Shop::find($data['id']);
        $shop->password = Hash::make($data['password']);
        $shop->save();
        return redirect()->back()->with('message', 'Cập nhật mật khẩu thành công');
    }
    public function manage_users_list()
    {
        $user = User::where('role_id', 2)
        ->leftjoin('orders', 'users.id', '=', 'orders.user_id',)
        ->where('users.status', 1)
        ->select('users.id','users.status','users.firstname','users.lastname','users.email','users.userImg','users.created_at','users.updated_at', DB::raw('SUM(orders.order_total) as order_total'))
        ->groupBy('users.id', 'users.firstname', 'users.lastname', 'users.email', 'users.userImg', 'users.created_at', 'users.updated_at','users.status')
        ->get();
        // dd($user);
        return view('admin.manage_users_list', compact('user'));
    }
    public function stop_user(Request $request){
        $data = $request->all();
        $user = User::find($data['id']);
        $user->status = 2;
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Khóa người dùng thành công'
        ]);
        
    }
    public function manage_users_edit($email)
    {
        $user = User::where('email', $email)
        ->where('role_id', 2)
        ->first();
        // dd($shop);
        return view('admin.manage_users_edit', compact('user'));
    }
    public function manage_users_edits(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->back()->with('message', 'Cập nhật mật khẩu thành công');
    }
    public function manage_users_stop()
    {
        $user = User::where('role_id', 2)
        ->leftjoin('orders', 'users.id', '=', 'orders.user_id',)
        ->where('users.status', 2)
        ->select('users.id','users.status','users.firstname','users.lastname','users.email','users.userImg','users.created_at','users.updated_at', DB::raw('SUM(orders.order_total) as order_total'))
        ->groupBy('users.id', 'users.firstname', 'users.lastname', 'users.email', 'users.userImg', 'users.created_at', 'users.updated_at','users.status')
        ->get();
        // dd($user);
        return view('admin.manage_users_stop', compact('user'));
    }
    public function unclock_user(Request $request){
        $data = $request->all();
        $user = User::find($data['id']);
        $user->status = 1;
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Mở khóa người dùng thành công'
        ]);
        
    }
    public function add_subcategory(){
        $category = Categories::all();
        $sub_category = SubCategories::all();
        return view('admin.add_subcategory', compact('category', 'sub_category'));
    }
    public function add_subcategorys(Request $request){
        $data = $request->all();
        $sub_category_name= Subcategories::select('subCategoryName') ->where('category_id', $data['category'])->get();
        foreach($sub_category_name as $key => $value){
            if($value->subCategoryName == $data['subcategory']){
                return redirect()->back()->with('error', 'Danh mục phụ đã tồn tại');
            }
        }
        $subcategory = new SubCategories();
        $subcategory->category_id = $data['category'];
        $subcategory->subcategoryName = $data['subcategory'];
        $subcategory->created_at = date('Y-m-d H:i:s');
        $subcategory->updated_at = date('Y-m-d H:i:s');
        $subcategory->save();
        return redirect()->back()->with('message', 'Thêm danh mục phụ thành công');
    }
    public function manage_category(){
        $category = Categories::leftjoin('subcategories', 'categories.id', '=', 'subcategories.category_id')
        ->select('categories.id','categories.categoryName','categories.categoryIcon' , DB::raw('COUNT(subcategories.category_id) as count'))
        ->groupBy('categories.id', 'categories.categoryName', 'categories.categoryIcon')
        ->get();
        return view('admin.manage_category', compact('category'));
    }
    public function manage_category_edit($category_id){
        $category = Categories::where('id', $category_id)->first();
        return view('admin.manage_category_edit', compact('category'));
    }
    public function manage_category_edits(Request $request){
        $data = $request->all();
        $all_categoryName= Categories::select('categoryName') ->get();
        $category = Categories::find($data['id']);
        foreach($all_categoryName as $key => $value){
            if($value->categoryName == $data['categoryName']){
                return redirect()->back()->with('error', 'Tên danh mục đã tồn tại');
            }
        }
        if($request->hasFile('categoryIcon')){
            $delete_file=unlink('storage/'.$category->categoryIcon);
            $category->categoryIcon = $request->file('categoryIcon')->store('logo_category','public');
        }
        $category->categoryName = $data['categoryName'];
        $category->save();
        return redirect()->back()->with('message', 'Cập nhật danh mục thành công');
    }
    public function manage_subcategory($category_id){
        $category = Categories::where('id', $category_id)->first();
        $sub_category = SubCategories::where('category_id', $category_id)->get();
        return view('admin.manage_subcategory', compact('category', 'sub_category'));
    }
    public function manage_subcategory_edit($subcategory_id){
        $subcategory = SubCategories::where('id', $subcategory_id)->first();
        $categoryName= Categories::select('categoryName') ->where('id', $subcategory->category_id)->first();
        return view('admin.manage_subcategory_edit', compact('subcategory','categoryName'));
    }
    public function manage_subcategory_edits(Request $request){
        $data = $request->all();
        $all_subcategoryName= SubCategories::select('subCategoryName') ->where('category_id', $data['category_id'])->get();
        foreach($all_subcategoryName as $key => $value){
            if($value->subCategoryName == $data['subCategoryName']){
                return redirect()->back()->with('error', 'Tên danh mục phụ đã tồn tại');
            }
        }
        $subcategory = SubCategories::find($data['id']);
        $subcategory->subCategoryName = $data['subCategoryName'];
        $subcategory->save();
        return redirect()->back()->with('message', 'Cập nhật danh mục phụ thành công');
    }
    public function add_coupon(){
        return view('admin.add_coupon');
    }
    public function add_coupons(Request $request){
        $data = $request->all();
        if($data['coupon_type'] == 2 && $data['coupon_value'] >= 100){
            return redirect()->back()->with('error', 'Giá trị giảm giá không được lớn hơn 100%');
        }
        if($data['coupon_type'] == 1 && $data['coupon_value'] >= 1000000){
            return redirect()->back()->with('error', 'Giá trị giảm giá không được lớn hơn 1.000.000đ');
        }
        if($data['coupon_type'] == 1 && $data['coupon_value'] < 1000){
            return redirect()->back()->with('error', 'Giá trị giảm giá không được nhỏ hơn 1.000đ');
        }
        if($data['coupon_type'] == 2 && $data['coupon_value'] < 1){
            return redirect()->back()->with('error', 'Giá trị giảm giá không được nhỏ hơn 1%');
        }
        $old_coupon = DB::table('coupon')
        ->select('coupon_code')
        ->get();
        foreach($old_coupon as $key => $value){
            if($value->coupon_code == $data['coupon_code']){
                return redirect()->back()->with('error', 'Mã giảm giá đã tồn tại');
            }
        }
        $coupon = new Coupon();
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_value = $data['coupon_value'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_amount = $data['coupon_amount'];
        $coupon->created_at = date('Y-m-d H:i:s');
        $coupon->save();
        return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
    }
    public function manage_coupon(){
        $coupon = Coupon::all();
        return view('admin.manage_coupon', compact('coupon'));
    }
    public function delete_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::find($data['id']);
        $coupon->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa mã giảm giá thành công'
        ]);
    }
}
