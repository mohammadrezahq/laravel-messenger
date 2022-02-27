<?php

namespace App\Main\Chat;

use App\Main\App;
use App\Models\Chat;

class CreateNewChat extends App {

    public function create($users)
    {
        $chat = new Chat();
        $chat->users = $users;
        $chat->save();

        return $chat;
    }

}
