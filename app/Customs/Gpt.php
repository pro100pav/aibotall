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
        $gpt = GptKey::where([['error', 0],['send', 0]])->first();
        if($gpt){
            $result = Http::timeout(60)->withHeaders([
                "Authorization" => "Bearer ".$gpt->key_api,
            ])->withOptions(["verify"=>false])->post($gpt->link,[
                "model" => "GigaChat:latest",
                "messages" => [
                        [
                            "role"=> "user",
                            "content"=> $res
                        ],
                    ],
                "temperature"=> 0.7
            ]);
            
            if(isset($result->json()['choices'])){
                return $result->json()['choices'][0]['message']['content'];
            }else if(isset($result->json()['error'])){
                $token = $this->Autorization();
                if($token != 0){
                    $gpt->key_api = $token;
                    $gpt->save();
                    return $this->aibot($res);
                }
                $gpt->send = 1;
                $gpt->error = 1;
                $gpt->save();
                return 'не валид';
            }else if(isset($result->json()['status'])){
                $token = $this->Autorization();
                if($token != 0){
                    $gpt->key_api = $token;
                    $gpt->save();
                    return $this->aibot($res);
                }
                $gpt->send = 1;
                $gpt->save();
                return 'не валид';
            }else{
                $gpt->error = 0;
                $gpt->send = 1;
                $gpt->save();
                return 0;
            }
        }else{
            return 0;
        }
        
    }

    function Autorization(){
        $result = Http::withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded",
            "RqUID" => "5caae699-f93c-4875-b587-a64f8152b371",
            "Authorization" => "Bearer NWNhYWU2OTktZjkzYy00ODc1LWI1ODctYTY0ZjgxNTJiMzcxOmU4MTNjZTAyLWIxOTQtNDc1OC05Njg4LTljYTg0MjNmODZlOQ==",
        ])
        ->withBody(
            'scope=GIGACHAT_API_PERS', 'application/x-www-form-urlencoded'
        )
        ->withOptions(["verify"=>false])
        ->post('https://ngw.devices.sberbank.ru:9443/api/v2/oauth');
        if($result->json()){
            if(isset($result->json()['access_token'])){
                return $result->json()['access_token'];
            }else{
                return 0;
            }
        }
    }
}