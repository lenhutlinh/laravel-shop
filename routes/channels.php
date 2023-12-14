<?php

use Illuminate\Support\Facades\Broadcast;
use App\Http\Middleware\CheckingShopLogin;
use App\Http\Middleware\CheckingUserLogin;
use App\Models\Shop;
use App\Models\Users;
use App\Models\Messages;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('sendMessageToUser.{user_id}', function (Users $user, $user_id) {
    return $user->id === $user_id;
});

Broadcast::channel('sendMessageToShop.{shop_id}', function (Shop $shop, $shop_id) {
    return $shop->id === $shop_id; 
});
// Broadcast::channel('sendMessageToUser.{user_id}', function ($user_id) {
//     return true;
//     echo'ok';
// });