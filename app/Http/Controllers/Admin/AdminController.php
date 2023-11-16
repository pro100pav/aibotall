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
        
        $result = Http::timeout(60)->withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded",
            "Authorization" => "Bearer ".$request->token,
            "RqUID" => $request->client,
            "scope" => "scope=GIGACHAT_API_CORP",
        ])->post('https://ngw.devices.sberbank.ru:9443/api/v2/oauth',[]);
        dd($result);
        return view('adminka.index');
    }
    
}