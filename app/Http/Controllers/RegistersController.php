<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use Session;

class RegistersController extends Controller
{
    public function index(){
        return view('index');
    }
    public function Registers(){
        return view('user.registers');
    }
    public function registers_user(Request $request){
        $email= Users::select('email')->get();
        foreach ($email as $key => $value) {
            if ($request->email == $value->email) {
                return redirect()->back()->with('error','Email đã tồn tại') ;
            }
        }
        $data=array();
        $data['lastname']=$request->lastname;
        $data['firstname']=$request->firstname;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $data['role_id']=2;
        $data['status']=1;
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        Users::insert($data);
        return redirect()->route('login')->with('message','Đã đăng ký thành công') ;
        // $data=$request->validate([
        //     'firstname' => 'required|max:50',
        //     'lastname' => 'required|max:50',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required',
        //     'password_confirm' => 'required|same:password',
        // ]);
        // $user = new Users();
        // $user->firstname = $request->firstname;
        // $user->lastname = $request->lastname;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->role_id = 2;
        // $user->status = 1;
        // $user->save();
        // return redirect()->route('login')->with('message','Đăng ký thành công');
    }
    
    public function login(){
        if(Session::get('user_id')){
            return redirect()->back();
        }
        return view('user.login');
    }
    public function login_user(Request $request)
    {
        $product_id = Session::get('product_id');
        $email = $request->email;
        $password = $request->password;

        $result = DB::table('users')->where('email', $email)->first();

        if ($result == null) {
            return redirect()->route('login')->with('error', 'Sai tài khoản hoặc mật khẩu');
        }

        // 1️⃣ Kiểm tra trạng thái khóa
        if ($result->status == 2) {
            return redirect()->route('login')->with('error', 'Tài khoản đã bị khóa vĩnh viễn');
        }

        // 2️⃣ Kiểm tra nếu bị khóa tạm thời
        if (!empty($result->locked_until) && strtotime($result->locked_until) > time()) {
            $remaining = ceil((strtotime($result->locked_until) - time()) / 60);
            return redirect()->route('login')->with('error', "Tài khoản bị khóa tạm thời. Vui lòng thử lại sau {$remaining} phút.");
        }

        // 3️⃣ Kiểm tra mật khẩu
        if (Hash::check($password, $result->password)) {
            // ✅ Đăng nhập thành công → reset lại số lần sai và thời gian khóa
            DB::table('users')->where('id', $result->id)->update([
                'login_attempts' => 0,
                'locked_until' => null
            ]);

            // Tạo session
            Session::put('user_id', $result->id);
            Session::put('user_name', $result->firstname . ' ' . $result->lastname);
            Session::put('user_email', $result->email);
            Session::put('user_img', $result->userImg);
            $count_cart = DB::table('cart')->where('user_id', $result->id)->count();
            Session::put('count_cart', $count_cart);

            // ✅ Điều hướng
            if ($product_id) {
                return redirect()->route('detail_product', $product_id);
            } else {
                return redirect()->route('index');
            }

        } else {
            // ❌ Sai mật khẩu → tăng biến đếm
            $newAttempts = $result->login_attempts + 1;
            $updateData = ['login_attempts' => $newAttempts];

            if ($newAttempts == 3) {
                // ⏳ Khóa tạm 5 phút
                $updateData['locked_until'] = now()->addMinutes(5);
                DB::table('users')->where('id', $result->id)->update($updateData);
                return redirect()->route('login')->with('error', 'Bạn đã nhập sai 3 lần. Tài khoản bị khóa tạm thời trong 5 phút.');
            } 
            elseif ($newAttempts >= 5) {
                // 🔒 Khóa vĩnh viễn
                $updateData['status'] = 2; // 2 = khóa vĩnh viễn
                DB::table('users')->where('id', $result->id)->update($updateData);
                return redirect()->route('login')->with('error', 'Tài khoản đã bị khóa vĩnh viễn do nhập sai quá 5 lần.');
            } 
            else {
                DB::table('users')->where('id', $result->id)->update($updateData);
                return redirect()->route('login')->with('error', 'Sai mật khẩu. Bạn còn ' . (3 - $newAttempts) . ' lần thử trước khi bị khóa tạm thời.');
            }
        }
    }

    public function logout_user(){
        Session::forget('user_id');
        Session::forget('user_name');
        Session::forget('user_email');
        Session::forget('count_cart');
       
        $product_id = Session::get('product_id');
        if($product_id){
            return redirect()->route('detail_product',$product_id);
        }else{
            return redirect()->route('index');
        }
    }
}