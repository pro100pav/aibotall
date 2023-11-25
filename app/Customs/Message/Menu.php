<?php

namespace App\Customs\Message;

use App\Models\User;
use App\Models\Bot\Bot;
use App\Models\Bot\BotChat;
use App\Models\Bot\UserChatBot;
use App\Models\Gpt\GptKey;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Keyboard\Keyboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class Menu
{
    public function index($req){
        
    }
    public function status($chatid){
        $user = BotChat::where('id_telegram', $chatid)->first();
        if($user->role == 1){
            return 'Пользователь';
        }
        if($user->role == 2){
            return 'Совладелец';
        }
    }
}