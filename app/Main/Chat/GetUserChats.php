<?php

namespace App\Main\Chat;

use App\Main\App;
use App\Models\Chat;
use App\Models\User;

class GetUserChats extends App {

    public function get()
    {
        $chats = Chat::whereJsonContains('users', $this->user()->id)->get();

        foreach ($chats as $chat) {
            foreach (json_decode($chat->users) as $user) {
                if ($user !== $this->user()->id) {
                    $chat->user = User::select('id', 'name', 'profile_photo_path')->where('id', $user)->first();
                }
            }
        }

        return $chats;
    }

}
