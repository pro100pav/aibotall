<?php

namespace App\Customs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function index($req){
        $name;
        $username;
        $uid_telegram = 0;
        if(isset($req["message"]["chat"]["id"])){
            $uid_telegram = $result["message"]["chat"]["id"];
        }
        if(isset($info["message"]["chat"]["first_name"])){
            $name = $info["message"]["chat"]["first_name"];
        }
        if(isset($info["message"]["chat"]["username"])){
            $username = $info["message"]["chat"]["username"];
        }
        $password = str_random(8);
        $user = User::create([
            'name' => $name,
            'username' => $username,
            'uid_telegram' => $uid_telegram,
            'password' => Hash::make($password),
        ]);
        if(!$user->username){
            $user->username = 'Guest_'.$user->id;
            $user->save();
            $username = 'Guest_'.$user->id;
        }
        return ['login' => $username, 'password' => $password];
    }
}