<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request){    
        return view('game');
    }
    public function bot(Request $request){

        $token = '6651918059:AAFiXybZSR-7J_DEDeFgh15SP4HEFpJRu98';
        $telegram = new Api($token);
        $result = $telegram->getWebhookUpdates();

        if (isset($result["message"])) {
            
            $chat_id = '';
            if(isset($result["message"]["chat"]["id"])){
                $chat_id = $result["message"]["chat"]["id"];
            }
            $text = '';
            if(isset($result["message"]["text"])){
                $text = $result["message"]["text"];
            }
            $button = Keyboard::make(
                [ 
                    'inline_keyboard' => [
                        [
                            [
                                'text' => 'Играть',
                                'url' => 'https://t.me/BuildingTw_bot/appbtw'
                            ]
                        ]
                    ]
                ]);
            if($text){
                if($text == '/start'){
                    try {
                        $response = $telegram->sendMessage([
                            'chat_id' => $chat_id,
                            'text' => 'Привет',
                            
                        ]);
                    } catch (TelegramResponseException $e) {
                        $response = $telegram->sendMessage([
                            'chat_id' => $chat_id,
                            'text' => 'Привет yt',
                        ]);
                    }
                }
            }
        }
    }
}
