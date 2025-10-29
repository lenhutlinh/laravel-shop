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
use App\Models\CommissionRate;
use App\Models\Order;
use App\Services\CommissionSyncService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
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
        $total_order = DB::table('orders')->where('order_status', 5)->count();
        // Tính tổng hoa hồng sàn nhận được từ các đơn hàng hoàn thành
        $total_money = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->sum('order_commissions.commission_amount');
        $total_pending = DB::table('orders')->where('order_status', 0)->count();
        // Tính hoa hồng theo từng tháng
        $earning_month_1 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-01-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_2 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-02-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_3 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-03-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_4 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-04-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_5 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-05-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_6 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-06-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_7 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-07-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_8 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-08-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_9 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-09-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_10 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-10-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_11 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-11-01')))
            ->sum('order_commissions.commission_amount');
        $earning_month_12 = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->where('order_commissions.status', 'completed')
            ->whereMonth('orders.updated_at', date('m',strtotime('2025-12-01')))
            ->sum('order_commissions.commission_amount');
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
        
        // Tạo CommissionRate mặc định cho shop mới được duyệt
        $existingCommission = CommissionRate::where('shop_id', $shop->id)->first();
        if (!$existingCommission) {
            CommissionRate::create([
                'shop_id' => $shop->id,
                'rate' => 4.00,
                'total_commission' => 0.00,
                'pending_commission' => 0.00,
                'paid_commission' => 0.00,
                'status' => 'active'
            ]);
        }
        
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
        ->leftjoin('orders', 'shop.id', '=', 'orders.shop_id')
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

    public function add_category(Request $request){
        $data = $request->all();
        
        // Validate
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'categoryIcon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:500'
        ]);

        // Check if category name already exists
        $existingCategory = Categories::where('categoryName', $data['categoryName'])->first();
        if($existingCategory){
            return response()->json([
                'status' => false,
                'message' => 'Tên danh mục đã tồn tại'
            ]);
        }

        // Prepare data for mass assignment
        $categoryData = [
            'categoryName' => $data['categoryName'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Only add description if it's not empty
        if(!empty($data['description'])){
            $categoryData['description'] = $data['description'];
        }
        
        if($request->hasFile('categoryIcon')){
            $categoryData['categoryIcon'] = $request->file('categoryIcon')->store('logo_category','public');
        }
        
        // Create new category using mass assignment
        $category = Categories::create($categoryData);

        return response()->json([
            'status' => true,
            'message' => 'Thêm danh mục thành công'
        ]);
    }

    public function delete_category(Request $request){
        $data = $request->all();
        
        $category = Categories::find($data['id']);
        if(!$category){
            return response()->json([
                'status' => false,
                'message' => 'Danh mục không tồn tại'
            ]);
        }

        // Get all subcategories
        $subcategories = SubCategories::where('category_id', $data['id'])->get();
        $subcategoryCount = $subcategories->count();
        
        // Delete all subcategories first
        if($subcategoryCount > 0){
            foreach($subcategories as $subcategory){
                // First, delete all products in this subcategory
                $products = DB::table('products')->where('subcategory_id', $subcategory->id)->get();
                foreach($products as $product){
                    // Delete product images
                    $productImages = DB::table('products_images')->where('product_id', $product->id)->get();
                    foreach($productImages as $image){
                        if($image->imageProduct && file_exists('storage/'.$image->imageProduct)){
                            unlink('storage/'.$image->imageProduct);
                        }
                    }
                    // Delete product images from database
                    DB::table('products_images')->where('product_id', $product->id)->delete();
                    
                    // Delete product combinations
                    DB::table('products_combinations')->where('product_id', $product->id)->delete();
                    
                    // Delete product variations
                    $variationIds = DB::table('products_variations_options')->where('product_id', $product->id)->pluck('id');
                    DB::table('products_variations_options_value')->whereIn('products_variation_id', $variationIds)->delete();
                    DB::table('products_variations_options')->where('product_id', $product->id)->delete();
                    
                    // Delete the product
                    DB::table('products')->where('id', $product->id)->delete();
                }
                
                // Delete subcategory icon file if exists
                if($subcategory->subCategoryIcon && file_exists('storage/'.$subcategory->subCategoryIcon)){
                    unlink('storage/'.$subcategory->subCategoryIcon);
                }
                $subcategory->delete();
            }
        }

        // Delete category icon file
        if($category->categoryIcon && file_exists('storage/'.$category->categoryIcon)){
            unlink('storage/'.$category->categoryIcon);
        }

        $category->delete();

        $message = 'Xóa danh mục thành công';
        if($subcategoryCount > 0){
            $message .= ' (đã xóa ' . $subcategoryCount . ' danh mục phụ)';
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
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

    /**
     * Hiển thị trang quản lý hoa hồng
     */
    public function manage_commission()
    {
        // Sử dụng CommissionSyncService để tự động đồng bộ tất cả shops
        $syncService = new CommissionSyncService();
        $syncService->syncAllShopsCommission();

        $shops = Shop::with('commissionRate')
            ->where('status', '1')
            ->get();

        return view('admin.manage_commission', compact('shops'));
    }

    /**
     * Hiển thị chi tiết hoa hồng của một shop
     */
    public function commission_detail($shop_id)
    {
        $shop = Shop::with('commissionRate')->find($shop_id);
        
        if (!$shop) {
            return redirect()->back()->with('error', 'Không tìm thấy cửa hàng');
        }

        // Lấy các đơn hàng của shop này (status = 0,1,3,4,5 là có hoa hồng)
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.shop_id', $shop_id)
            ->whereIn('orders.order_status', [0, 1, 3, 4, 5])
            ->select('orders.*', 'users.firstname', 'users.lastname', 'users.email')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(20);

        // Đếm tổng số đơn hàng có hoa hồng
        $totalOrders = Order::where('shop_id', $shop_id)
            ->whereIn('order_status', [0, 1, 3, 4, 5])
            ->count();

        return view('admin.commission_detail', compact('shop', 'orders', 'totalOrders'));
    }

    /**
     * Cập nhật tỷ lệ hoa hồng
     */
    public function update_commission_rate(Request $request)
    {
        $data = $request->all();
        
        $commissionRate = CommissionRate::where('shop_id', $data['shop_id'])->first();
        
        if (!$commissionRate) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin hoa hồng'
            ]);
        }

        $commissionRate->rate = $data['rate'];
        $commissionRate->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật tỷ lệ hoa hồng thành công'
        ]);
    }

    /**
     * Thanh toán hoa hồng
     */
    public function pay_commission(Request $request)
    {
        $data = $request->all();
        
        $commissionRate = CommissionRate::where('shop_id', $data['shop_id'])->first();
        
        if (!$commissionRate) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin hoa hồng'
            ]);
        }

        $amount = $data['amount'];
        
        if ($amount > $commissionRate->pending_commission) {
            return response()->json([
                'status' => false,
                'message' => 'Số tiền thanh toán không được vượt quá hoa hồng chưa thanh toán'
            ]);
        }

        $success = $commissionRate->payCommission($amount);

        if ($success) {
            return response()->json([
                'status' => true,
                'message' => 'Thanh toán hoa hồng thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Thanh toán hoa hồng thất bại'
            ]);
        }
    }

    /**
     * Tính hoa hồng cho đơn hàng (gọi khi đơn hàng hoàn thành)
     */
    public function calculateOrderCommission($orderId)
    {
        $order = Order::find($orderId);
        
        if (!$order || $order->order_status !== 5) {
            return false;
        }

        $commissionRate = CommissionRate::where('shop_id', $order->shop_id)->first();
        
        if (!$commissionRate) {
            // Tạo commission rate mặc định nếu chưa có
            $commissionRate = CommissionRate::create([
                'shop_id' => $order->shop_id,
                'rate' => 4.00,
                'total_commission' => 0.00,
                'pending_commission' => 0.00,
                'paid_commission' => 0.00,
                'status' => 'active'
            ]);
        }

        // Tính hoa hồng (order_total đã là giá gốc, không cần trừ phí ship)
        $commissionAmount = $commissionRate->calculateCommission($order->order_total);
        $commissionRate->addCommission($commissionAmount);

        return true;
    }

    /**
     * Hiển thị trang Generate Report
     */
    public function generateReport()
    {
        // Lấy dữ liệu thống kê cơ bản
        $total_shop = Shop::where('status', 1)->count();
        $total_user = User::where('role_id', 2)->where('status', 1)->count();
        $total_order = DB::table('orders')->where('order_status', 5)->count();
        
        // Tổng doanh thu = Tổng hoa hồng (đã thanh toán + chưa thanh toán)
        $total_money = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5)
            ->sum('order_commissions.commission_amount');

        // Thống kê theo tháng (theo hoa hồng)
        $monthly_stats = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthly_stats[$i] = DB::table('order_commissions')
                ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
                ->where('orders.order_status', 5)
                ->whereMonth('orders.updated_at', $i)
                ->whereYear('orders.updated_at', date('Y'))
                ->sum('order_commissions.commission_amount');
        }

        // Thống kê theo quý (theo hoa hồng)
        $quarterly_stats = [];
        for ($i = 1; $i <= 4; $i++) {
            $startMonth = ($i - 1) * 3 + 1;
            $endMonth = $i * 3;
            $quarterly_stats[$i] = DB::table('order_commissions')
                ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
                ->where('orders.order_status', 5)
                ->whereMonth('orders.updated_at', '>=', $startMonth)
                ->whereMonth('orders.updated_at', '<=', $endMonth)
                ->whereYear('orders.updated_at', date('Y'))
                ->sum('order_commissions.commission_amount');
        }

        // Thống kê theo năm (5 năm gần nhất) - theo hoa hồng
        $yearly_stats = [];
        for ($i = 4; $i >= 0; $i--) {
            $year = date('Y') - $i;
            $yearly_stats[$year] = DB::table('order_commissions')
                ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
                ->where('orders.order_status', 5)
                ->whereYear('orders.updated_at', $year)
                ->sum('order_commissions.commission_amount');
        }

        // Top shops theo hoa hồng
        $top_shops = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('shop', 'shop.id', '=', 'orders.shop_id')
            ->where('orders.order_status', 5)
            ->select('shop.shopname', DB::raw('SUM(order_commissions.commission_amount) as total_revenue'))
            ->groupBy('shop.id', 'shop.shopname')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();

        // Doanh thu theo tài khoản khách hàng (theo hoa hồng từ đơn hàng của họ)
        $revenue_by_customer = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.order_status', 5)
            ->select('users.firstname', 'users.lastname', 'users.email', 
                    DB::raw('SUM(order_commissions.commission_amount) as total_revenue'),
                    DB::raw('SUM(orders.order_total) as total_order_value'),
                    DB::raw('COUNT(orders.id) as total_orders'))
            ->groupBy('users.id', 'users.firstname', 'users.lastname', 'users.email')
            ->orderBy('total_revenue', 'desc')
            ->limit(15)
            ->get();

        // Doanh thu theo mặt hàng (theo hoa hồng từ sản phẩm)
        $revenue_by_product = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_detail.product_id')
            ->where('orders.order_status', 5)
            ->select('products.productName', 
                    DB::raw('SUM(order_commissions.commission_amount) as total_revenue'),
                    DB::raw('SUM(order_detail.product_quantity) as total_quantity'),
                    DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->groupBy('products.id', 'products.productName')
            ->orderBy('total_revenue', 'desc')
            ->limit(15)
            ->get();

        // Doanh thu theo danh mục sản phẩm (theo hoa hồng)
        $revenue_by_category = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_detail.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('orders.order_status', 5)
            ->select('categories.categoryName', 
                    DB::raw('SUM(order_commissions.commission_amount) as total_revenue'),
                    DB::raw('SUM(order_detail.product_quantity) as total_quantity'))
            ->groupBy('categories.id', 'categories.categoryName')
            ->orderBy('total_revenue', 'desc')
            ->get();

        // Thống kê thanh toán theo phương thức (theo hoa hồng)
        $payment_methods = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('payment', 'payment.id', '=', 'orders.payment_id')
            ->where('orders.order_status', 5)
            ->select('payment.payment_method', 
                    DB::raw('SUM(order_commissions.commission_amount) as total_revenue'),
                    DB::raw('COUNT(orders.id) as total_orders'))
            ->groupBy('payment.payment_method')
            ->get();

        // Chuyển đổi payment_method thành text
        $payment_method_names = [
            1 => 'Thanh toán khi nhận hàng',
            2 => 'Thanh toán online VNPay',
            3 => 'Thanh toán online MoMo'
        ];

        foreach ($payment_methods as $method) {
            $method->method_name = $payment_method_names[$method->payment_method] ?? 'Không xác định';
        }

        return view('admin.generate_report', compact(
            'total_shop', 'total_user', 'total_order', 'total_money', 
            'monthly_stats', 'quarterly_stats', 'yearly_stats',
            'top_shops', 'revenue_by_customer', 'revenue_by_product', 
            'revenue_by_category', 'payment_methods'
        ));
    }





    /**
     * Tải xuống báo cáo theo định dạng
     */
    public function downloadReport($type, Request $request)
    {
        if (!in_array($type, ['excel', 'csv'])) {
            return redirect()->back()->with('error', 'Định dạng không được hỗ trợ');
        }

        // Debug logging
        \Log::info('Report Export Request', [
            'type' => $type,
            'all_params' => $request->all(),
            'user_id' => auth()->id(),
            'is_admin' => auth()->check()
        ]);

        // Lấy tham số từ request
        $reportType = $request->get('reportType', 'summary');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $includeStats = $request->get('includeStats') === 'true';
        $includeCharts = $request->get('includeCharts') === 'true';
        $includeCustomers = $request->get('includeCustomers') === 'true';
        $includeProducts = $request->get('includeProducts') === 'true';
        $includeCategories = $request->get('includeCategories') === 'true';
        $includeShops = $request->get('includeShops') === 'true';
        $pageSize = $request->get('pageSize', 'A4');
        $orientation = $request->get('orientation', 'portrait');
        $notes = $request->get('notes', '');

        // Xây dựng query với điều kiện thời gian
        $orderQuery = DB::table('orders')->where('order_status', 5);
        if ($startDate) {
            $orderQuery->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $orderQuery->whereDate('created_at', '<=', $endDate);
        }

        // Lấy dữ liệu thống kê cơ bản
        $total_shop = Shop::where('status', 1)->count();
        $total_user = User::where('role_id', 2)->where('status', 1)->count();
        $total_order = $orderQuery->count();
        
        $total_money = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->where('orders.order_status', 5);
        
        if ($startDate) {
            $total_money->whereDate('orders.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $total_money->whereDate('orders.created_at', '<=', $endDate);
        }
        
        $total_money = $total_money->sum('order_commissions.commission_amount');

        $data = [
            'total_shop' => $total_shop,
            'total_user' => $total_user,
            'total_order' => $total_order,
            'total_money' => $total_money,
            'generated_at' => now()->format('d/m/Y H:i:s'),
            'report_type' => $reportType,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'include_stats' => $includeStats,
            'include_charts' => $includeCharts,
            'include_customers' => $includeCustomers,
            'include_products' => $includeProducts,
            'include_categories' => $includeCategories,
            'include_shops' => $includeShops,
            'page_size' => $pageSize,
            'orientation' => $orientation,
            'notes' => $notes
        ];

        // Debug logging dữ liệu
        \Log::info('Report Export Data', [
            'basic_stats' => [
                'total_shop' => $total_shop,
                'total_user' => $total_user,
                'total_order' => $total_order,
                'total_money' => $total_money
            ],
            'options' => [
                'include_stats' => $includeStats,
                'include_customers' => $includeCustomers,
                'include_products' => $includeProducts,
                'include_categories' => $includeCategories,
                'include_shops' => $includeShops
            ]
        ]);

        if ($type === 'excel') {
            return $this->generateExcelReport($data);
        } elseif ($type === 'csv') {
            return $this->generateCSVReport($data);
        }
    }


    /**
     * Tạo báo cáo Excel với giao diện đẹp
     */
    private function generateExcelReport($data)
    {
        $filename = 'bao_cao_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        // Lấy dữ liệu chi tiết cho báo cáo
        $detailedData = $this->getDetailedReportData($data['start_date'], $data['end_date']);
        
        // Tạo HTML content cho Excel
        $html = $this->generateExcelHTML($data, $detailedData);
        
        return response($html)
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
    
    /**
     * Lấy dữ liệu chi tiết cho báo cáo
     */
    private function getDetailedReportData($startDate = null, $endDate = null)
    {
        // Query cơ bản
        $orderQuery = DB::table('orders')->where('order_status', 5);
        if ($startDate) {
            $orderQuery->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $orderQuery->whereDate('created_at', '<=', $endDate);
        }
        
        // Doanh thu theo khách hàng
        $revenue_by_customer = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.order_status', 5);
            
        if ($startDate) {
            $revenue_by_customer->whereDate('orders.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $revenue_by_customer->whereDate('orders.created_at', '<=', $endDate);
        }
        
        $revenue_by_customer = $revenue_by_customer
            ->select(
                'users.firstname',
                'users.lastname',
                DB::raw('SUM(order_commissions.commission_amount) as total_revenue'),
                DB::raw('SUM(orders.order_total) as total_order_value'),
                DB::raw('COUNT(orders.id) as total_orders')
            )
            ->groupBy('users.id', 'users.firstname', 'users.lastname')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
            
        // Doanh thu theo sản phẩm
        $revenue_by_product = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_detail.product_id')
            ->where('orders.order_status', 5);
            
        if ($startDate) {
            $revenue_by_product->whereDate('orders.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $revenue_by_product->whereDate('orders.created_at', '<=', $endDate);
        }
        
        $revenue_by_product = $revenue_by_product
            ->select(
                'products.productName',
                DB::raw('SUM(order_commissions.commission_amount) as total_revenue'),
                DB::raw('SUM(order_detail.product_quantity) as total_quantity')
            )
            ->groupBy('products.id', 'products.productName')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
            
        // Doanh thu theo danh mục
        $revenue_by_category = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_detail.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('orders.order_status', 5);
            
        if ($startDate) {
            $revenue_by_category->whereDate('orders.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $revenue_by_category->whereDate('orders.created_at', '<=', $endDate);
        }
        
        $revenue_by_category = $revenue_by_category
            ->select(
                'categories.categoryName',
                DB::raw('SUM(order_commissions.commission_amount) as total_revenue')
            )
            ->groupBy('categories.id', 'categories.categoryName')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
            
        // Doanh thu theo cửa hàng
        $revenue_by_shop = DB::table('order_commissions')
            ->join('orders', 'orders.id', '=', 'order_commissions.order_id')
            ->join('shops', 'shops.id', '=', 'orders.shop_id')
            ->where('orders.order_status', 5);
            
        if ($startDate) {
            $revenue_by_shop->whereDate('orders.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $revenue_by_shop->whereDate('orders.created_at', '<=', $endDate);
        }
        
        $revenue_by_shop = $revenue_by_shop
            ->select(
                'shops.shop_name',
                DB::raw('SUM(order_commissions.commission_amount) as total_revenue')
            )
            ->groupBy('shops.id', 'shops.shop_name')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
        
        return [
            'revenue_by_customer' => $revenue_by_customer,
            'revenue_by_product' => $revenue_by_product,
            'revenue_by_category' => $revenue_by_category,
            'revenue_by_shop' => $revenue_by_shop
        ];
    }
    
    /**
     * Tạo HTML content cho Excel
     */
    private function generateExcelHTML($data, $detailedData)
    {
        $logoPath = asset('img/icon.jpg'); // Đường dẫn logo
        $currentDate = now()->format('d/m/Y');
        
        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta charset="utf-8">
            <meta name="ExcelFormat" content="html">
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .logo { max-width: 150px; max-height: 100px; margin-bottom: 20px; }
                .title { font-size: 24px; font-weight: bold; color: #1E5F74; margin-bottom: 10px; }
                .subtitle { font-size: 16px; color: #666; margin-bottom: 20px; }
                .date-info { font-size: 14px; color: #888; }
                .stats-grid { display: table; width: 100%; margin: 20px 0; }
                .stats-row { display: table-row; }
                .stats-cell { display: table-cell; width: 25%; padding: 15px; text-align: center; border: 1px solid #ddd; background: #f9f9f9; }
                .stats-number { font-size: 20px; font-weight: bold; color: #1E5F74; }
                .stats-label { font-size: 12px; color: #666; margin-top: 5px; }
                .section { margin: 30px 0; }
                .section-title { font-size: 18px; font-weight: bold; color: #1E5F74; margin-bottom: 15px; border-bottom: 2px solid #1E5F74; padding-bottom: 5px; }
                .data-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
                .data-table th { background: #1E5F74; color: white; padding: 12px 8px; text-align: center; font-weight: bold; }
                .data-table td { padding: 10px 8px; border: 1px solid #ddd; text-align: center; }
                .data-table tr:nth-child(even) { background: #f9f9f9; }
                .data-table tr:hover { background: #f0f8ff; }
                .signature-section { margin-top: 50px; text-align: right; }
                .signature-line { border-bottom: 1px solid #333; width: 200px; margin: 20px 0 5px auto; }
                .signature-text { font-size: 14px; color: #666; }
                .footer { margin-top: 40px; text-align: center; font-size: 12px; color: #888; }
            </style>
        </head>
        <body>';
        
        // Header với logo
        $html .= '<div class="header">
            <img src="' . $logoPath . '" alt="Logo Shop" class="logo" onerror="this.style.display=\'none\'">
            <div class="title">BÁO CÁO TỔNG QUAN HỆ THỐNG</div>
            <div class="subtitle">Báo cáo doanh thu và thống kê</div>
            <div class="date-info">Ngày tạo: ' . $currentDate . '</div>
        </div>';
        
        // Thống kê tổng quan
        $html .= '<div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-number">' . $data['total_shop'] . '</div>
                    <div class="stats-label">Tổng Cửa Hàng</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">' . $data['total_user'] . '</div>
                    <div class="stats-label">Tổng Người Dùng</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">' . $data['total_order'] . '</div>
                    <div class="stats-label">Tổng Đơn Hàng</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">' . number_format($data['total_money'], 0, ',', '.') . 'đ</div>
                    <div class="stats-label">Tổng Doanh Thu</div>
                </div>
            </div>
        </div>';
        
        // Doanh thu theo khách hàng
        if ($detailedData['revenue_by_customer']->count() > 0) {
            $html .= '<div class="section">
                <div class="section-title">DOANH THU THEO TÀI KHOẢN KHÁCH HÀNG</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khách Hàng</th>
                            <th>Tổng Giá Đơn Hàng</th>
                            <th>Doanh Thu</th>
                            <th>Đơn Hàng</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            foreach ($detailedData['revenue_by_customer'] as $index => $customer) {
                $html .= '<tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $customer->firstname . ' ' . $customer->lastname . '</td>
                    <td>' . number_format($customer->total_order_value, 0, ',', '.') . 'đ</td>
                    <td>' . number_format($customer->total_revenue, 0, ',', '.') . 'đ</td>
                    <td>' . $customer->total_orders . '</td>
                </tr>';
            }
            
            $html .= '</tbody></table></div>';
        }
        
        // Doanh thu theo sản phẩm
        if ($detailedData['revenue_by_product']->count() > 0) {
            $html .= '<div class="section">
                <div class="section-title">DOANH THU THEO SẢN PHẨM</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sản Phẩm</th>
                            <th>Doanh Thu</th>
                            <th>Số Lượng</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            foreach ($detailedData['revenue_by_product'] as $index => $product) {
                $html .= '<tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $product->productName . '</td>
                    <td>' . number_format($product->total_revenue, 0, ',', '.') . 'đ</td>
                    <td>' . $product->total_quantity . '</td>
                </tr>';
            }
            
            $html .= '</tbody></table></div>';
        }
        
        // Doanh thu theo danh mục
        if ($detailedData['revenue_by_category']->count() > 0) {
            $html .= '<div class="section">
                <div class="section-title">DOANH THU THEO DANH MỤC</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Danh Mục</th>
                            <th>Doanh Thu</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            foreach ($detailedData['revenue_by_category'] as $index => $category) {
                $html .= '<tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $category->categoryName . '</td>
                    <td>' . number_format($category->total_revenue, 0, ',', '.') . 'đ</td>
                </tr>';
            }
            
            $html .= '</tbody></table></div>';
        }
        
        // Doanh thu theo cửa hàng
        if ($detailedData['revenue_by_shop']->count() > 0) {
            $html .= '<div class="section">
                <div class="section-title">DOANH THU THEO CỬA HÀNG</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Cửa Hàng</th>
                            <th>Doanh Thu</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            foreach ($detailedData['revenue_by_shop'] as $index => $shop) {
                $html .= '<tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $shop->shop_name . '</td>
                    <td>' . number_format($shop->total_revenue, 0, ',', '.') . 'đ</td>
                </tr>';
            }
            
            $html .= '</tbody></table></div>';
        }
        
        // Phần ký tên
        $html .= '<div class="signature-section">
            <div class="signature-line"></div>
            <div class="signature-text">Người lập báo cáo</div>
            <div style="margin-top: 30px;">
                <div class="signature-line"></div>
                <div class="signature-text">Người duyệt</div>
            </div>
        </div>';
        
        // Footer
        $html .= '<div class="footer">
            <p>Báo cáo được tạo tự động bởi hệ thống quản lý thương mại điện tử</p>
            <p>Thời gian tạo: ' . $data['generated_at'] . '</p>
        </div>';
        
        $html .= '</body></html>';
        
        return $html;
    }

    /**
     * Tạo báo cáo CSV
     */
    private function generateCSVReport($data)
    {
        $filename = 'bao_cao_' . date('Y-m-d') . '.csv';
        
        $csv = "Chỉ số,Giá trị\n";
        $csv .= "Tổng số cửa hàng," . $data['total_shop'] . "\n";
        $csv .= "Tổng số người dùng," . $data['total_user'] . "\n";
        $csv .= "Tổng số đơn hàng," . $data['total_order'] . "\n";
        $csv .= "Tổng doanh thu," . $data['total_money'] . "\n";
        $csv .= "Ngày tạo," . $data['generated_at'] . "\n";

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
