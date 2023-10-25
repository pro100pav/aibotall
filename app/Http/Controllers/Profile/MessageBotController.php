<?php

namespace App\Http\Controllers\Profile;

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

class MessageBotController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $bot = BotChat::where('id_telegram', $user->uid_telegram)->first();
        dd($bot->UserMessage);
        return view('profile.message', compact('user'));
    }
    
}
