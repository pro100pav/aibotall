<?php

namespace App\Customs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function index($req){
        $name;
        $username;
        $uid_telegram = 0;
        if(isset($req["message"]["chat"]["id"])){
            $uid_telegram = $req["message"]["chat"]["id"];
        }
        if(isset($req["message"]["chat"]["first_name"])){
            $name = $req["message"]["chat"]["first_name"];
        }
        if(isset($req["message"]["chat"]["username"])){
            $username = $req["message"]["chat"]["username"];
        }
        if(User::where('uid_telegram', $uid_telegram)->first()){
            return 'Существует';
        }
        $password = Str::password(8);
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