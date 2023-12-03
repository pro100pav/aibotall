<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bot\BotChat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function turbo(Request $request){
        $token = $request->token;
        $gptUser = BotChat::where('token', $token)->first();
        if($gptUser){
            $gptUser->requests += 200;
            $gptUser->save();
            return response()->json([
                'success' => true,
                'data' => 1,
            ]);
        }else{
            return response()->json([
                'success' => true,
                'data' => 'Не найден',
            ]);
        }
        
    }
}
