<?php

namespace App\Main\Message;

use App\Main\App;
use App\Models\Message;

class GetChatMessages extends App {

    public function get($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->orderBy('created_at', 'DESC')->get();
        return $this->return($messages);
    }

}
