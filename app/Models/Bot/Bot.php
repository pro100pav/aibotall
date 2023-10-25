<?php

namespace App\Models\Bot;

use App\Models\Bot\BotChat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'name',
    ];

    public function Chat()
    {
      return $this->hasMany(BotChat::class, 'bot_id');
    }
}
