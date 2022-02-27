<?php

namespace App\Main\Chat;

use App\Main\App;
use App\Models\Chat;

class GetUserChats extends App {

    public function get()
    {
        $chats = Chat::with('user:id,name,profile_photo_path')->whereJsonContains('users', $this->user()->id)->get();
        return $chats;
    }

}
