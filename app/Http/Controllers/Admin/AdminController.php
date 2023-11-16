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
        $token = 'eyJjdHkiOiJqd3QiLCJlbmMiOiJBMjU2Q0JDLUhTNTEyIiwiYWxnIjoiUlNBLU9BRVAtMjU2In0.TlEV-sYNTA2r_afWuSd3IilqgHmz91pkJtFO-RiCkyI9wdLX0HBHjNehi48oZJnCiQ0bkLf1yWmmTA2APmfXfhWX9-YsKrMiRvpEpdTz3vJ5YDp6Ng2lB-r819NEjKfS89Lrto8N6J5cZJPxFh71--W-sjbJJvk_8w_0hHfCwuwXbc9nwxSNGaKa3RKo6-h1hfqSM0LHaOtcukJs_2NdjEsxpUnKItzSOGOKs60Y3eQ53bXdZSbos4BeAt9Yrpbbyrv_4S8__mBRCNQohwqql7Xy-y2GHcQDjJsOVOe8A4Kj9sqTKchrX5tSYIM852w8-QLqt9Je-Gqbl62SLG9B_A.ct1D-HMJIY_TGZrZqurbxw.H21n-MlqheVrYw_KuTz77T-paXe6WB2lOrtWKFGyY9Ebk0hj-FFOCLz-tUGJTlago7odc-0fv0tSvzlP3yo9xWYmIBVm_Sy4YM5TkQOalwKtiTDYndr990E_FjIVTOG_blKkTS8ML9QDw-MfrGHNxCgCmXbI1SvoXLPCpjcTLKueQ5JblCGlSXk6qwDtx8y6waY-BQYqBgEGySePLRMjboLszABQ_FxIHYsHE4gqbFjj9vUpXnFWmhuAuMY5nw8QbEFnz8V8XtCjAlPaV-LPcIlc1pWl8J6HJocANtcuxTfTzZ938wzCBFPJZkICT_zSvy5kmgvDof4iyhWOGqx9ZRI3qJW031kQXJwFv1elyTbawvd0bdRSty77C3nH62UPaHACSpmD8PBYStoJS-6iIjq61GcGS3dE8O8vmDLLbddmcZAilEnbusw80_eUxndRcJzfs_CFz27rgW7XR3Otz0QXkuun5T8xeyyLEhxR6hH9YLg2D439zzD6Wxg_dwQY1r_LaaNSqdkX3GZH9Ngk6-2BJ_fV_IWuRGDMqymQ78UxlXslfbAlhakmB8m_sCDaROHGL_YtMFdO2UiIQYwTfycl8X8BC4zUUV2M7TvGCPm_UiXBqWhSMwpHCclovfG0EdhO3TLIntg2T6HaEospwbXjUIgDxAwtWAFFiL19bozXxjxXdKhOi81zO6Nwipk38tGVf6QbhfrL_BE2nm6-5GN0F8c3QcGClxsK-8RWJGY.QbvwU7wu0AwIP4lIkU4R5DgTIJvdHrK-EtUyjT760RQ';
        
        
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
