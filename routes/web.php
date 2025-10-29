<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistersController;
use App\Http\Controllers\RegistersShopController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckingShopLogin;
use App\Http\Middleware\CheckingUserLogin;
use App\Http\Middleware\CheckingAdminLogin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchSuggestionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;
use App\Events\SendMessageUser;
use Pusher\Pusher;

#dang ky dap nhap user
Route::get('login', [RegistersController::class, 'login'])->name('login');
Route::get('registers', [RegistersController::class, 'registers'])->name('registers');
Route::post('registers_user', [RegistersController::class, 'registers_user'])->name('registers_user');
Route::post('login_user', [RegistersController::class, 'login_user'])->name('login_user');
Route::get('logout_user', [RegistersController::class, 'logout_user'])->name('logout_user');

Route::get('/', [UserController::class, 'index'])->name('index');
// About page
Route::get('about', function(){
    return view('about');
})->name('about');
// Support page
Route::get('support', function(){
    return view('support');
})->name('support');
Route::get('/detail_product/{product_id}',[UserController::class, 'detail_product'])->name('detail_product');
Route::get('view_shop/{shop_id}',[UserController::class, 'view_shop'])->name('view_shop');
Route::get('choose_subcategory',[UserController::class, 'choose_subcategory'])-> name('choose_subcategory');


Route::get('choose_popular',[UserController::class, 'choose_popular'])-> name('choose_popular');
Route::get('choose_newest',[UserController::class, 'choose_newest'])-> name('choose_newest');
Route::get('choose_best_sell',[UserController::class, 'choose_best_sell'])-> name('choose_best_sell');
Route::get('choose_high_low',[UserController::class, 'choose_high_low'])-> name('choose_high_low');
Route::get('choose_low_high',[UserController::class, 'choose_low_high'])-> name('choose_low_high');
Route::GET('search_products',[SearchController::class, 'search_products'])-> name('search_products');
Route::GET('category_products/{categoryName}',[SearchController::class, 'category_products'])-> name('category_products');

// Search Suggestions API
Route::get('api/search-suggestions', [SearchSuggestionController::class, 'getSuggestions'])->name('search_suggestions');
Route::post('api/track-search', [SearchSuggestionController::class, 'trackSearch'])->name('track_search');
Route::get('api/hot-keywords', [SearchSuggestionController::class, 'getHotKeywords'])->name('hot_keywords');
Route::get('api/related-products', [SearchSuggestionController::class, 'getRelatedProducts'])->name('related_products');
Route::get('api/search-history', [SearchSuggestionController::class, 'getSearchHistory'])->name('search_history');
Route::post('api/save-search-history', [SearchSuggestionController::class, 'saveSearchHistory'])->name('save_search_history');
Route::GET('price_arround',[SearchController::class, 'price_arround'])-> name('price_arround');
Route::get('search_choose_subcategory',[SearchController::class, 'search_choose_subcategory'])-> name('search_choose_subcategory');
Route::get('search_choose_popular',[SearchController::class, 'search_choose_popular'])-> name('search_choose_popular');
Route::get('search_choose_newest',[SearchController::class, 'search_choose_newest'])-> name('search_choose_newest');
Route::get('search_choose_best_sell',[SearchController::class, 'search_choose_best_sell'])-> name('search_choose_best_sell');
Route::get('search_choose_high_low',[SearchController::class, 'search_choose_high_low'])-> name('search_choose_high_low');
Route::get('search_choose_low_high',[SearchController::class, 'search_choose_low_high'])-> name('search_choose_low_high');
Route::get('category_choose_subcategory',[SearchController::class, 'category_choose_subcategory'])-> name('category_choose_subcategory');
Route::get('category_choose_popular',[SearchController::class, 'category_choose_popular'])-> name('category_choose_popular');
Route::get('category_choose_newest',[SearchController::class, 'category_choose_newest'])-> name('category_choose_newest');
Route::get('category_choose_best_sell',[SearchController::class, 'category_choose_best_sell'])-> name('category_choose_best_sell');
Route::get('category_choose_high_low',[SearchController::class, 'category_choose_high_low'])-> name('category_choose_high_low');
Route::get('category_choose_low_high',[SearchController::class, 'category_choose_low_high'])-> name('category_choose_low_high');

// Forgot password (USER)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token'    => 'required',
        'email'    => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email','password','password_confirmation','token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
            ])->save();
        }
    );
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');
#dang ky dang nhap ban hang
Route::get('register_shop', [RegistersShopController::class, 'register_shop'])->name('register_shop');
Route::get('login_shop', [RegistersShopController::class, 'login_shop'])->name('login_shop');
Route::POST('registers_shop', [RegistersShopController::class, 'registers_shop'])->name('registers_shop');
Route::POST('logins_shop', [RegistersShopController::class, 'logins_shop'])->name('logins_shop');

# trang ban hang
Route::group([
    'middleware' => CheckingShopLogin::class],function(){
        Route::get('logout_shop', [RegistersShopController::class, 'logout_shop'])->name('logout_shop');
        Route::get('index_shop', [ShopController::class, 'index_shop'])->name('index_shop');
        Route::get('add_product', [ShopController::class, 'add_product'])->name('add_product');
        Route::get('shop_profile', [ShopController::class, 'shop_profile'])->name('shop_profile');
        Route::post('change_profile_shop',[ShopController::class, 'change_profile_shop'])-> name('change_profile_shop');
        Route::get('shop_password', [ShopController::class, 'shop_password'])->name('shop_password');
        Route::post('change_password_shop',[ShopController::class, 'change_password_shop'])-> name('change_password_shop');

        Route::get('select_category', [ShopController::class, 'select_category'])->name('select_category');
        // Route::post('shop_add_product', [ShopController::class, 'shop_add_product'])->name('shop_add_product');
        Route::get('shop_add_products', [ShopController::class, 'shop_add_products'])->name('shop_add_products');
        Route::get('add_product_quantity', [ShopController::class, 'add_product_quantity'])->name('add_product_quantity');
        Route::get('manage_product', [ShopController::class, 'manage_product'])->name('manage_product');
        Route::post('add_product_quantitys', [ShopController::class, 'add_product_quantitys'])->name('add_product_quantitys');
        Route::post('/stop_product_ajax',[ShopController::class, 'stop_product_ajax'])-> name('stop_product_ajax');
        Route::post('/start_product_ajax',[ShopController::class, 'start_product_ajax'])-> name('start_product_ajax');
        Route::get('edit_product/{product_id}', [ShopController::class, 'edit_product'])->name('edit_product');
        Route::post('/update_product',[ShopController::class, 'update_product'])-> name('update_product');
        Route::post('/delete_preview_image',[ShopController::class, 'delete_preview_image'])-> name('delete_preview_image');
        Route::post('/delete_product_image',[ShopController::class, 'delete_product_image'])-> name('delete_product_image');
        Route::get('manage_order', [ShopController::class, 'manage_order'])->name('manage_order');
        Route::get('manage_order_cancel', [ShopController::class, 'manage_order_cancel'])->name('manage_order_cancel');
        Route::post('/accept_order',[ShopController::class, 'accept_order'])-> name('accept_order');
        Route::post('/cancel_order',[ShopController::class, 'cancel_order'])-> name('cancel_order');
        Route::post('/update_order_status',[ShopController::class, 'update_order_status'])-> name('update_order_status');
        Route::get('view_order_detail/{order_id}', [ShopController::class, 'view_order_detail'])->name('view_order_detail');
        Route::get('chat_shop', [ChatController::class, 'chat_shop'])->name('chat_shop');
        Route::get('/chat_shop/show/{user_id}',[ChatController::class, 'show_chat_shop'])-> name('show_chat_shop');
        Route::post('/send_messages_shop',[ChatController::class, 'send_messages_shop'])-> name('send_messages_shop');
       
}); 
Route::group([
    'middleware' => CheckingUserLogin::class],function(){
        //Trang giỏ hàng
        Route::post('/add_cart_ajax',[UserController::class, 'add_cart_ajax'])-> name('add_cart_ajax');
        Route::get('/show_cart_ajax',[UserController::class, 'show_cart_ajax'])-> name('show_cart_ajax');
        Route::post('/user_cancel_order',[UserController::class, 'user_cancel_order'])-> name('user_cancel_order');
        Route::post('/plus_cart_ajax',[CartController::class, 'plus_cart_ajax'])-> name('plus_cart_ajax');
        Route::post('/minus_cart_ajax',[CartController::class, 'minus_cart_ajax'])-> name('minus_cart_ajax');
        Route::post('/update_cart_ajax',[CartController::class, 'update_cart_ajax'])-> name('update_cart_ajax');
        Route::post('/delete_cart_ajax',[CartController::class, 'delete_cart_ajax'])-> name('delete_cart_ajax');
        Route::get('/choose_shop',[CartController::class, 'choose_shop'])-> name('choose_shop');
        Route::get('choose_coupon', [CheckoutController::class, 'choose_coupon'])->name('choose_coupon');
        

        
        //Trang thanh toán
        Route::get('/checkout',[CheckoutController::class, 'checkout'])-> name('checkout');
        Route::get('/buy_now_ajax',[CheckoutController::class, 'buy_now_ajax'])-> name('buy_now_ajax');
        Route::get('/checkout_now',[CheckoutController::class, 'checkout_now'])-> name('checkout_now');
        Route::POST('/order',[CheckoutController::class, 'order'])-> name('order');
        Route::POST('/order_now',[CheckoutController::class, 'order_now'])-> name('order_now');
        Route::get('choose_coupon',[CheckoutController::class, 'choose_coupon'])-> name('choose_coupon');
        Route::get('choose_coupon_now',[CheckoutController::class, 'choose_coupon_now'])-> name('choose_coupon_now');
        Route::post('calculate-shipping',[CheckoutController::class, 'calculateShipping'])-> name('calculate.shipping');
        
        // Online Payment Routes
        Route::get('/online-payment',[CheckoutController::class, 'onlinePayment'])-> name('online_payment');
        Route::post('/process-momo-payment',[CheckoutController::class, 'processMomoPayment'])-> name('process_momo_payment');
        Route::post('/process-vnpay-payment',[CheckoutController::class, 'processVnpayPayment'])-> name('process_vnpay_payment');
        
        Route::get('/after_order',[CheckoutController::class, 'after_order'])-> name('after_order');
        // Removed cancel payment route to disable manual cancel flow during test payment
        Route::get('/review_order',[CheckoutController::class, 'review_order'])-> name('review_order');
        //Trang tài khoản
        Route::get('/user/purchase',[CheckoutController::class, 'user_purchase'])-> name('user_purchase');
        Route::get('/user/account',[CheckoutController::class, 'user_account'])-> name('user_account');
        Route::post('/change_profile_user',[CheckoutController::class, 'change_profile_user'])-> name('change_profile_user');
        Route::get('/user/password',[CheckoutController::class, 'user_password'])-> name('user_password');
        Route::post('/change_password_user',[CheckoutController::class, 'change_password_user'])-> name('change_password_user');
        //Trang tin nhắn
        Route::get('/chat',[ChatController::class, 'chat_user'])-> name('chat_user');
        Route::get('/chat/show/{shop_id}',[ChatController::class, 'show_chat'])-> name('show_chat');
        Route::post('/send_messages_user',[ChatController::class, 'send_messages_user'])-> name('send_messages_user');
        
        //Rating routes
        Route::post('/rating/store',[RatingController::class, 'store'])-> name('rating_store');
        Route::get('/rating/product/{product_id}',[RatingController::class, 'getProductRatings'])-> name('product_ratings');
        
        //Comment routes
        Route::post('/comment/store',[RatingController::class, 'storeComment'])-> name('comment_store');
        
        //Reorder routes
        Route::post('/reorder',[CheckoutController::class, 'reorder'])-> name('reorder');
        
}); 

// Payment Callback Routes (không cần middleware vì callback từ payment gateway)
Route::post('/momo-callback',[CheckoutController::class, 'momoCallback'])-> name('momo_callback');
Route::get('/vnpay-callback',[CheckoutController::class, 'vnpayCallback'])-> name('vnpay_callback');

Route::get('/login_admin',[AdminController::class, 'login_admin'])-> name('login_admin');
Route::post('/logins_admin',[AdminController::class, 'logins_admin'])-> name('logins_admin');
Route::group([
    'middleware' => CheckingAdminLogin::class],function(){
        Route::get('/dashboard_admin',[AdminController::class, 'dashboard_admin'])-> name('dashboard_admin');
        Route::get('logout_admin', [AdminController::class, 'logout_admin'])->name('logout_admin');
        Route::get('manage_shop_regist', [AdminController::class, 'manage_shop_regist'])->name('manage_shop_regist');
        Route::get('manage_shop_list', [AdminController::class, 'manage_shop_list'])->name('manage_shop_list');
        Route::get('manage_shop_edit/{shopname}', [AdminController::class, 'manage_shop_edit'])->name('manage_shop_edit');
        Route::post('manage_shop_edits',[AdminController::class, 'manage_shop_edits'])-> name('manage_shop_edits');
        Route::get('manage_shop_stop', [AdminController::class, 'manage_shop_stop'])->name('manage_shop_stop');
        Route::post('accept_shop',[AdminController::class, 'accept_shop'])-> name('accept_shop');
        Route::post('delete_shop',[AdminController::class, 'delete_shop'])-> name('delete_shop');
        Route::post('stop_shop',[AdminController::class, 'stop_shop'])-> name('stop_shop');
        Route::get('manage_users_list', [AdminController::class, 'manage_users_list'])->name('manage_users_list');
        Route::get('manage_users_stop', [AdminController::class, 'manage_users_stop'])->name('manage_users_stop');
        Route::get('manage_users_edit/{email}', [AdminController::class, 'manage_users_edit'])->name('manage_users_edit');
        Route::post('unclock_user',[AdminController::class, 'unclock_user'])-> name('unclock_user');
        Route::post('manage_users_edits',[AdminController::class, 'manage_users_edits'])-> name('manage_users_edits');
        Route::post('stop_user',[AdminController::class, 'stop_user'])-> name('stop_user');
        Route::get('manage_banner_index', [AdminController::class, 'manage_banner_index'])->name('manage_banner_index');
        Route::get('add_subcategory', [AdminController::class, 'add_subcategory'])->name('add_subcategory');
        Route::post('add_subcategorys',[AdminController::class, 'add_subcategorys'])-> name('add_subcategorys');
        Route::get('manage_category', [AdminController::class, 'manage_category'])->name('manage_category');
        Route::get('manage_category_edit/{category_id}', [AdminController::class, 'manage_category_edit'])->name('manage_category_edit');
        Route::post('manage_category_edits',[AdminController::class, 'manage_category_edits'])-> name('manage_category_edits');
        Route::post('add_category', [AdminController::class, 'add_category'])->name('add_category');
        Route::post('delete_category', [AdminController::class, 'delete_category'])->name('delete_category');
        Route::get('manage_category/manage_subcategory/{category_id}', [AdminController::class, 'manage_subcategory'])->name('manage_subcategory');
        Route::get('manage_category/manage_subcategory/manage_subcategory_edit/{subcategory_id}', [AdminController::class, 'manage_subcategory_edit'])->name('manage_subcategory_edit');
        Route::post('manage_subcategory_edits',[AdminController::class, 'manage_subcategory_edits'])-> name('manage_subcategory_edits');
        Route::get('add_coupon', [AdminController::class, 'add_coupon'])->name('add_coupon');
        Route::POST('add_coupons', [AdminController::class, 'add_coupons'])->name('add_coupons');
        Route::get('manage_coupon', [AdminController::class, 'manage_coupon'])->name('manage_coupon');
        Route::POST('delete_coupon', [AdminController::class, 'delete_coupon'])->name('delete_coupon');
        
        // Commission Management Routes
        Route::get('manage_commission', [AdminController::class, 'manage_commission'])->name('manage_commission');
        Route::get('commission_detail/{shop_id}', [AdminController::class, 'commission_detail'])->name('commission_detail');
        Route::post('update_commission_rate', [AdminController::class, 'update_commission_rate'])->name('update_commission_rate');
        Route::post('pay_commission', [AdminController::class, 'pay_commission'])->name('pay_commission');
        
        // Shop Location Management Routes
        Route::get('shop-locations', [App\Http\Controllers\ShopLocationController::class, 'index'])->name('shop.locations');
        Route::put('shop-locations/{id}', [App\Http\Controllers\ShopLocationController::class, 'update'])->name('shop.locations.update');
        Route::get('shop-locations/{id}', [App\Http\Controllers\ShopLocationController::class, 'show'])->name('shop.locations.show');
        Route::post('shop-locations/bulk-update', [App\Http\Controllers\ShopLocationController::class, 'bulkUpdate'])->name('shop.locations.bulk-update');
        
        // Generate Report Routes
        Route::get('generate-report', [AdminController::class, 'generateReport'])->name('generate_report');
        Route::get('download-report/{type}', [AdminController::class, 'downloadReport'])->name('download_report');
        
        // Private Coupons Routes
        Route::resource('private-coupons', App\Http\Controllers\PrivateCouponController::class);
        Route::post('private-coupons/check', [App\Http\Controllers\PrivateCouponController::class, 'checkPrivateCoupon'])->name('private_coupons.check');

});     