<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Customs\Gpt;
use App\Models\Bot\UserChatBot;
use App\Models\Bot\BotChat;
use App\Models\Gpt\GptKey;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request){
        return view('adminka.index');
    }
    public function authSber(Request $request){
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
                        "content"=> 'Что такое автомобиль'
                    ],
                ],
                'temperature' => 0,
            ]);

            if(isset($result->json()['choices'])){
                dd(1);
                return $result->json()['choices'][0]['message']['content'];
            }else if(isset($result->json()['error'])){
                dd(2);
                //return $this->aibot($res);
            }else{
                dd(3);
                return 0;
            }
        }else{
            return 'Закончились';
        }


        dd($result,$result->json());
        return view('adminka.index');
    }
    function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
           
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            mt_rand( 0, 0xffff ),
           
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}
