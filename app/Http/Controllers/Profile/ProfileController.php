<?php

namespace App\Http\Controllers\Profile;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Customs\Gpt;
use App\Models\Bot\BotChat;
use App\Models\Bot\UserChatBot;
use App\Models\Gpt\GptKey;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
    public function messagefind(Request $request, $id){
        $text = UserChatBot::find($id);
        
        return view('message', compact('text'));
    }
    public function turbo(Request $request){
        // $user = Auth::user();
        // $token = Str::random(10);
        // $botchat = BotChat::where('id_telegram',$user->uid_telegram)->first();
        // $botchat->token = $token;
        // $botchat->save();
        // $result = Http::withHeaders([
        //     "Content-Type" => "application/json",
        // ])
        // ->post('http://social/api/isset-turbo', [
        //     'token' => $token,
        //     'id' => $request->id,
        // ]);
        // $res = $result->json()['data']
        // return view('message', compact('text','res'));
    }
}
