<?php

namespace App\Main\Chat;

use App\Main\App;
use App\Models\Chat;

class GetChat extends App {

    public function get(Int $chat_id)
    {
        $chat = Chat::where('id', $chat_id)->first();
        return $this->return($chat);
    }

}
