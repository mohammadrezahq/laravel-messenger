<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;

    public function getDataAttribute($value) {
        return json_decode($value);
    }

    public function getUserAttribute() {

        foreach (json_decode($this->users) as $user) {
            if ($user !== Auth::id()) {
                return User::select('id', 'name', 'profile_photo_path')->where('id', $user)->first();
            }
        }

    }
}
