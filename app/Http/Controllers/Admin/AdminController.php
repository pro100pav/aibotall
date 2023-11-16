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
        
        dd($result,$result->json()['access_token']);
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
