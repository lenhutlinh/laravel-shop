<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Redirect;

use Session;
session_start();

class RegistersShopController extends Controller
{
    public function register_shop(){
        return view('shop.register_shop');
    }
    public function login_shop(){
        if(Session::get('shop_id')){
            return redirect()->back();
        }
        return view('shop.login_shop');
    }
    public function registers_shop(Request $request){
        $name_shop= Shop::select('shopname')->get();
        foreach ($name_shop as $key => $value) {
            if ($request->shop_name == $value->shopname) {
                return redirect()->back()->with('error','Tên shop đã tồn tại') ;
            }
        }
        $email= Shop::select('email')->get();
        foreach ($email as $key => $value) {
            if ($request->email == $value->email) {
                return redirect()->back()->with('error','Email đã tồn tại') ;
            }
        }
        $shop = new Shop();
        $shop->shopname = $request->shop_name;
        $shop->email = $request->email;
        $shop->password = Hash::make($request->password);
        if($request->hasFile('shopImg')){
            $shop_img = $request->file('shopImg')->store('logo_shop','public');
            $shop->shopImg = $shop_img;
        }
        
        // Lưu địa chỉ và tọa độ
        if($request->shop_full_address) {
            $shop->address = $request->shop_full_address;
        }
        if($request->shop_latitude) {
            $shop->latitude = $request->shop_latitude;
        }
        if($request->shop_longitude) {
            $shop->longitude = $request->shop_longitude;
        }
        
        $shop->role_id =1;
        $shop->status = 0; // chờ duyệt 1 là đã duyệt 2 là bị khóa
        $shop->save();
        return redirect()->route('login_shop')->with('success','Đăng ký thành công');
    }
    public function logins_shop(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        $result= DB::table('shop')->where('email',$email)->first();      
        if ($result) {
            if($result->status == 0){
                return redirect()->route('login_shop')->with('error','Tài khoản đang chờ duyệt');
            }
            if($result->status == 2){
                return redirect()->route('login_shop')->with('error','Tài khoản đã bị khóa');
            }
            if(Hash::check($password, $result->password ) ){
                Session:: put('shop_id',$result->id);
                Session:: put('shop_name',$result->shopname);
                Session:: put('shop_email',$result->email);
                Session:: put('shopImg',$result->shopImg);
                return redirect()->route('index_shop');
            }else{
                return redirect()->route('login_shop')->with('error','Sai email hoặc mật khẩu');
            }
        }else{
            return redirect()->route('login_shop')->with('error','Sai email hoặc mật khẩu');
        }
        
    }
    public function logout_shop(){
        Session::put('shop_id',null);
        Session::put('shop_name',null);
        Session::put('shop_email',null);
        Session::put('shopImg',null);
        return redirect()->route('login_shop');
    }
}
