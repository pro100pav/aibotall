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
                "Authorization" => "Bearer ".$gpt->key_api
            ])->withOptions(["verify"=>false])->post($gpt->link,[
                'model' => $gpt->model,
                "messages" => [
                    [
                        "role"=> "user",
                        "content"=> $res
                    ],
                ],
                'temperature' => 0,
            ]);
            Log::emergency($result);
            if(isset($result->json()['choices'])){
                Log::emergency('true');
                return $result->json()['choices'][0]['message']['content'];
            }else if(isset($result->json()['error'])){
                $gpt->error = 1;
                $gpt->save();
                return $this->aibot($res);
            }else{
                Log::emergency($result);
                $gpt->error = 1;
                $gpt->save();
                return 0;
            }
        }else{
            return 'Закончились';
        }
        
    }
}