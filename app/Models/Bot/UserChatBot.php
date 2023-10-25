<?php

namespace App\Models\Bot;

use App\Models\Bot\BotChat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChatBot extends Model
{
    use HasFactory;
    protected $fillable = [
        'bot_chat_id',
        'messagebot',
        'message_client',
        'close',
        'send',
    ];

    public function botChat()
    {
      return $this->belongsTo(BotChat::class);
    }
}
