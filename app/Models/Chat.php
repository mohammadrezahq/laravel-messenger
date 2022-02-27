<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;

    public function messages() {
        return $this->hasMany('App\Models\Message', 'chat_id', 'id');
    }
}
