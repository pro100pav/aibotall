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
        $token = 'eyJjdHkiOiJqd3QiLCJlbmMiOiJBMjU2Q0JDLUhTNTEyIiwiYWxnIjoiUlNBLU9BRVAtMjU2In0.rLRNOuy1PRqweUFgB-uJhg3Ps-y5xYtEJgeaRodcdflQ9g8pQPP75d-3-iFZazo7XKdITj1HJM6ujzHe6BZX_eVYdtxN0cp7LKrkJ9INMD5NwTen59KWhzjHJjYW_DJIHjjVzR_dxQIwJ-aVmBPi0zjpBzG2rCYbd3j7yrLEo40Vt6vc4QY1r7ePxIhCWhRL9oqlhCQgOlQDTsXW525imiuqaRjNNyVlknPhYAdXdpVpDLi0ROT7Rt5WCuCIbJNy826785hXkYBLzkdkOV0k-IGTP31fQKKV47XwxV8nFSPO8ZmX5OqJnvTMvvdjpnIHfnD-Aj02o1PHFgyX57pn2Q.jgGAr3EEHgQTl4GOiL8abg.WBkH34OLJayk0l0H9pAM9muos54TOX7ab8xMYsanG84oItFGd8A5cVrPIIDPxZ1Acp-C1GwVlve1f5fu-XFKY0J2F6Mg2WHDjKwFqCVwF5rQZJwxXCCCqwy1nqVBCsSNaW0jmNpBJtP78sCtJbwjBSTb0o28-MZuVH4LF4moceqKYiQXK4ci3X5QkoPqU4-u6MmpmnTuyvPi1j84S_bLTeoJaI4plNj_nSJPUm_0381vWIjjjrPt4sExf2_PFJqLNLvJQgyby09XANksK8L6IOFc7rDXNBH7cBX8WgsLVNC4ycbzyJGNqtv71q6uURvqLgCsUcf3SMxHJed98zKPJ_ij0gCf9XaLLaPfp039wYqcYTo71XkBTuYuOemfMTn2vVGNcE0oalC-De4DSBgdNAXIA0xU2h19zlZTs9MBfCDApo8HU_KW5xXqz17ErzxduNxQls_MxGrYYZ8UPIYQXPB1kIeS_sZafKsJxSvjE2cCkR6r1nW_YJMjHpzgICPUHWxlKQmQzkQenrT9bcgQTaYLHvuhen80fHUoGtI3nwHPQIjFX6Nyrb8OxSmJB800uAA2tiuwZ4PbcK1RcR1ejwLrfUMIyMmcJ9pU-d5hXnShOuIX10YsTrtnf0JNdew3WoykYtgI51CPanuhi9cGnGivCgFsjeH_62VEh-sA-K-j8M8I3Z44w_l2blA7kX2Qvn5RW2JLGXSqUXyM1rA75vfUG32FG5OWwUAwrZo-VG0.Mr08gxhKOFY-DTuiPFrsJ34qPS-Ysstv_aL9qHmUvrk';
        $result = Http::timeout(60)->withHeaders([
            "Authorization" => "Bearer ".$token,
        ])->withOptions(["verify"=>false])->post('https://gigachat.devices.sberbank.ru/api/v1/chat/completions',[
            "model"=> "GigaChat:latest",
            "messages" => [
                    [
                        "role"=> "user",
                        "content"=> "Когда уже ИИ захватит этот мир?"
                    ],
                ],
            "temperature"=> 0.7
        ]);


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
