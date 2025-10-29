<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\Shop;
use App\Models\Messages;
use App\Models\Users;
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
use Pusher\Pusher;
use App\Events\SendMessageUser;

use Session;

class ChatController extends Controller
{
    public function chat_user(){
        $user_id = Session::get('user_id');
        $shop_list_unread  = DB::table('shop')
        ->leftjoin('messages', 'shop.id', '=', 'messages.shop_id')
        ->where('user_id', $user_id)
        ->where('sender', 1)
        ->where('messages.status', 0)
        ->select('shop.id', 'shop.shopname', 'shop.shopImg', DB::raw('count(messages.status) as unread'))
        ->groupBy('shop.id', 'shop.shopname', 'shop.shopImg')
        ->get();
        
        $shop_list  = DB::table('shop')
        ->join('messages', 'shop.id', '=', 'messages.shop_id')
        ->where('user_id', $user_id)
        ->where('sender', 1)
        ->where('messages.status', 1)
        ->select('shop.id', 'shop.shopname', 'shop.shopImg')
        ->groupBy('shop.id', 'shop.shopname', 'shop.shopImg')
        ->get();
        // $shop_list_unread = $shop_list_unread->union($shop_list);
        // dd($shop_list);

        foreach($shop_list as $shop){
            foreach($shop_list_unread as $shop1){
                if($shop->id == $shop1->id){
                    $shop_list = $shop_list->reject(function ($value, $key) use($shop1) {
                        return $value->id == $shop1->id;
                    });
                }
            }
        }
        // dd($shop_list_unread);
        
        return view('chat.chat_user', compact('shop_list', 'shop_list_unread'));
    }
    public function show_chat($shop_id){
        $user_id = Session::get('user_id');
        $user_img = Session::get('user_img');
        
        $shop_chat = DB::table('shop')
        ->select('id', 'shopname', 'shopImg')
        ->where('id', $shop_id)
        ->first();
        // dd($shop_chat);
        $read_messages = DB::table('messages')
        ->where('shop_id', $shop_chat->id)
        ->where('user_id', $user_id)
        ->where('sender', 1)
        ->update(['status' => 1]);
        $shop_list_unread  = DB::table('shop')
        ->leftjoin('messages', 'shop.id', '=', 'messages.shop_id')
        ->where('user_id', $user_id)
        ->where('sender', 1)
        ->where('messages.status', 0)
        ->select('shop.id', 'shop.shopname', 'shop.shopImg', DB::raw('count(messages.status) as unread'))
        ->groupBy('shop.id', 'shop.shopname', 'shop.shopImg')
        ->get();
        
        $shop_list  = DB::table('shop')
        ->join('messages', 'shop.id', '=', 'messages.shop_id')
        ->where('user_id', $user_id)
        ->where('sender', 1)
        ->where('messages.status', 1)
        ->select('shop.id', 'shop.shopname', 'shop.shopImg')
        ->groupBy('shop.id', 'shop.shopname', 'shop.shopImg')
        ->get();

        foreach($shop_list as $shop){
            foreach($shop_list_unread as $shop1){
                if($shop->id == $shop1->id){
                    $shop_list = $shop_list->reject(function ($value, $key) use($shop1) {
                        return $value->id == $shop1->id;
                    });
                }
            }
        }
        
        $messages = DB::table('messages')        
        ->select('id', 'user_id', 'shop_id', 'sender', 'message', 'status', 'created_at')
        ->where('shop_id', $shop_id)
        ->where('user_id', $user_id)
        ->get();
        
        return view('chat.show_chat_user' , compact('shop_chat', 'shop_list', 'messages', 'user_img', 'user_id','shop_list_unread'));
    }
    public function send_messages_user(Request $request){
        $request->validate([
            'message' => 'required',
        ]);
        $message = $request->message;
        $user_id = $request->user_id;
        $shop_id = $request->shop_id;
        $sender = 2; // 1 là shop, 2 là user
        $created_at = now(); 
        $data = array();
        $data['user_id'] = $user_id;
        $data['shop_id'] = $shop_id;
        $data['sender'] = 2; // 1 là shop, 2 là user
        $data['message'] = $message;
        $data['status'] = 0;
        $data['created_at'] = now();
        // dd($data);
        DB::table('messages')->insert($data);
        broadcast(new SendMessageUser($message, $user_id, $shop_id, $sender, $created_at))->toOthers();
        // event(new SendMessageUser($message, $user_id, $shop_id, $sender));
       
        return response()->json([
            'status' => true,
        ]);
    }
    public function send_messages_shop(Request $request){
        $request->validate([
            'message' => 'required',
        ]);
        $message = $request->message;
        $user_id = $request->user_id;
        $shop_id = $request->shop_id;
        $sender = 1; // 1 là shop, 2 là user
        $created_at = now();    
        $data = array();
        $data['user_id'] = $user_id;
        $data['shop_id'] = $shop_id;
        $data['sender'] = 1; // 1 là shop, 2 là user
        $data['message'] = $message;
        $data['status'] = 0;
        $data['created_at'] = now();
        // dd($data);
        DB::table('messages')->insert($data);

        broadcast(new SendMessageUser($message, $user_id, $shop_id, $sender,$created_at))->toOthers();

        return response()->json([
            'status' => true,
        ]);
    }

    public function chat_shop(){
        $shop_id = Session::get('shop_id');
        
        $user_list_unread = DB::table('users')
        ->join('messages', 'users.id', '=', 'messages.user_id')
        ->select('users.id', 'users.firstname','users.lastname', 'users.userImg', DB::raw('count(messages.status) as unread'))
        ->where('shop_id', $shop_id)
        ->where('messages.sender', '=', 2)
        ->where('messages.status', 0)
        ->groupBy('users.id', 'users.firstname','users.lastname', 'users.userImg')
        ->get();

        $user_list = DB::table('users')
        ->join('messages', 'users.id', '=', 'messages.user_id')
        ->select('users.id', 'users.firstname','users.lastname', 'users.userImg')
        ->where('shop_id', $shop_id)
        ->where('messages.sender', '=', 2)
        ->where('messages.status', 1)
        ->groupBy('users.id', 'users.firstname','users.lastname', 'users.userImg')
        ->get();
        foreach($user_list as $user){
            foreach($user_list_unread as $user1){
                if($user->id == $user1->id){
                    $user_list = $user_list->reject(function ($value, $key) use($user1) {
                        return $value->id == $user1->id;
                    });
                }
            }
        }
        return view('chat.chat_shop', compact('user_list', 'user_list_unread'));
    }
    public function show_chat_shop($user_id){
        $shop_id = Session::get('shop_id');
        $shop_img = Session::get('shopImg');
        
        $user_chat = DB::table('users')
        ->select('id', 'firstname','lastname', 'userImg')
        ->where('id', $user_id)
        ->first();
        // dd($user_chat);
        $read_messages = DB::table('messages')
        ->where('shop_id', $shop_id)
        ->where('user_id', $user_chat->id)
        ->where('sender', 2)
        ->update(['status' => 1]);
        $user_list_unread = DB::table('users')
        ->join('messages', 'users.id', '=', 'messages.user_id')
        ->select('users.id', 'users.firstname','users.lastname', 'users.userImg', DB::raw('count(messages.status) as unread'))
        ->where('shop_id', $shop_id)
        ->where('messages.sender', '=', 2)
        ->where('messages.status', 0)
        ->groupBy('users.id', 'users.firstname','users.lastname', 'users.userImg')
        ->get();

        $user_list = DB::table('users')
        ->join('messages', 'users.id', '=', 'messages.user_id')
        ->select('users.id', 'users.firstname','users.lastname', 'users.userImg')
        ->where('shop_id', $shop_id)
        ->where('messages.sender', '=', 2)
        ->where('messages.status', 1)
        ->groupBy('users.id', 'users.firstname','users.lastname', 'users.userImg')
        ->get();
        foreach($user_list as $user){
            foreach($user_list_unread as $user1){
                if($user->id == $user1->id){
                    $user_list = $user_list->reject(function ($value, $key) use($user1) {
                        return $value->id == $user1->id;
                    });
                }
            }
        }
        $messages = DB::table('messages')        
        ->select('id', 'user_id', 'shop_id', 'sender', 'message', 'status', 'created_at')
        ->where('shop_id', $shop_id)
        ->where('user_id', $user_id)
        ->get();
        
        // dd($shop_list);
        return view('chat.show_chat_shop' , compact('user_chat', 'user_list', 'messages', 'shop_img', 'shop_id','user_list_unread'));
    }
    
}
