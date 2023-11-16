<?php

namespace App\Models\Bot;

use App\Models\Bot\Bot;
use App\Models\Bot\UserChatBot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotChat extends Model
{
    use HasFactory;
    protected $fillable = [
        'bot_id',
        'id_telegram',
        'name',
        'nicname',
        'role',
        'requests',
    ];


    public function bot()
    {
      return $this->belongsTo(Bot::class);
    }
    public function UserMessage()
    {
      return $this->hasMany(UserChatBot::class, 'bot_chat_id');
    }
}
