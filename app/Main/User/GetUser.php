<?php

namespace App\Main\User;

use App\Main\App;
use App\Models\User;

class GetUser extends App {

    public function getByEmail(String $email)
    {
        return User::where('email', $email)->first();
    }

}
