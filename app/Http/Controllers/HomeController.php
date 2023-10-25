<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Customs\Gpt;
use App\Models\Bot\UserChatBot;
use App\Models\Gpt\GptKey;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $text = '';
        if ($request->isMethod('post')){
            $env = new Gpt();
            $resultgpt = $env->aibot($request->text);
            $text = $resultgpt;
            $text = Str::limit($resultgpt, 3000);
            dd(strlen($text), strlen($resultgpt));
        }
        
        return view('welcome', compact('text'));
    }
    public function messagefind(Request $request, $id){
        $text = UserChatBot::find($id);
        if(!$text){
            abort(404);
        }
        if($text->botChat->id_telegram != $request->key){
            abort(404);
        }
        return view('message', compact('text'));
    }
}
