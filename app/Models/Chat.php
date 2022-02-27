<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    public function messages() {
        return $this->hasMany('App\Models\Message', 'chat_id', 'id');
    }

    public function user() {

        $check = explode(',', $this->users);
        foreach($check as $key => $value) {
            if ($value == Auth::id()) {
                unset($check[$key]);
            }
        }
        $id = $check[0];

        return $this->hasOne('App\Models\User', 'id', $id);

    }
}
