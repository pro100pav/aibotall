<?php

namespace App\Facades;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin
{
    
    public function Chat()
    {
      return $this->hasMany(BotChat::class, 'bot_id');
    }
}
