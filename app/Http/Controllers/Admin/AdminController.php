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
        // $result = Http::withHeaders([
        //     "Content-Type" => "Application/json",
        // ])
        // ->withOptions(["verify"=>false])
        // ->post('https://iam.api.cloud.yandex.net/iam/v1/tokens', [
        //     'yandexPassportOauthToken' => 'y0_AgAAAAAG_q_1AATuwQAAAADymCKNrzODTHBSQ5iTKMelo0by2K_LdSI',
        // ]);

        $result = Http::timeout(60)->withHeaders([
            "Authorization" => "Bearer sk-YqqXqqNFUsgIySSDmfUUxYsI5HNQSmkr",
            "Content-Type" => "application/json",
            ])->withOptions(["verify"=>false])->post('https://api.proxyapi.ru/openai/v1/chat/completions',[
                "model" => "gpt-3.5-turbo-instruct",
                "messages" => [
                        [
                            "role"=> "user",
                            "content"=> 'Какие комплектующие используются для сборки настольного компьютера?'
                        ],
                    ],
                "temperature"=> 0.7
        ]);
        dd($result,$result->json());
        return view('adminka.index');
    }
    public function send(Request $request){
        
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
