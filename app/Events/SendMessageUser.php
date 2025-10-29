<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Models\Messages;
use App\Models\Shop;
use App\Models\Users;
class SendMessageUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $message;
    public $user_id;
    public $shop_id;
    public $sender;
    public $created_at;
    public function __construct($message, $user_id, $shop_id, $sender)
    {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->shop_id = $shop_id;
        $this->sender = $sender;
        $this->created_at = date('H:i  ', strtotime(now()));
    }

    public function broadcastOn()
    {
        // return new PrivateChannel('sendMessageToUser.'.$this->user_id);
        // return new PrivateChannel('sendMessageToShop.'.$this->shop_id);
        return [
            new PrivateChannel('sendMessageToUser.'.$this->user_id),
            new PrivateChannel('sendMessageToShop.'.$this->shop_id),
        ];
    }
    public function broadcastAs(): string
    {
        return 'send-message';
    }
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'user_id' => $this->user_id,
            'shop_id' => $this->shop_id,
            'sender' => $this->sender,
            'created_at' => $this->created_at,
        ];
        
    }
    
}
