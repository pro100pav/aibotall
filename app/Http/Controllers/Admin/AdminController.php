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
            "Authorization" => "Bearer t1.9euelZrMlZ6YiYmNncrNnJXOmY7Pl-3rnpWalp3Im5yej87Lkc-UncvHyZjl8_cCZAxV-e8OahJy_t3z90ISClX57w5qEnL-zef1656Vmsacl8fLy56Rx5PJkpeXyZGc7_zF656Vmsacl8fLy56Rx5PJkpeXyZGc.UqRQF5AiMOnYj8KZ3KkbRr9zjR_QNb3Uo70Hsk0FvWnvxCcqDsj7PPkE9JIbfef44bEztvbCGlGhM7kr9A4GAQ",
            "x-folder-id" => "b1go32f75293uersuemv",
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
        dd($result,$result->json()['iamToken']);
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
