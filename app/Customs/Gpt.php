<?php

namespace App\Customs;

use App\Http\Controllers\Controller;
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

class Gpt
{
    public function aibot($res){
        $gpt = GptKey::where('error', 0)->first();
        if($gpt){
            Log::emergency('попали');
            $result = Http::timeout(60)->withHeaders([
                "Content-Type" => "application/json",
                "Authorization" => "Bearer ".$gpt->key_api
            ])->post($gpt->link,[
                'model' => $gpt->model,
                'prompt' => $res,
                'max_tokens'=> 2048,
                'temperature' => 0,
            ]);
            if(isset($result->json()['choices'])){
                Log::emergency('true');
                return $result->json()['choices'][0]['text'];
            }else if(isset($result->json()['error'])){
                $gpt->error = 1;
                $gpt->save();
                Log::emergency('false');
                return $this->aibot($res);
            }else{
                Log::emergency('false1');
                return 0;
            }
        }else{
            return 'Закончились';
        }
        
    }
}