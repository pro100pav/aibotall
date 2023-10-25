<?php

namespace App\Models\Gpt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptKey extends Model
{
    use HasFactory;
    protected $fillable = [
        'key_api',
        'model',
        'link',
        'error',
    ];
}
