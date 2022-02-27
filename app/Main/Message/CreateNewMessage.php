<?php

namespace App\Main\Message;

use App\Main\App;
use App\Models\Message;
use App\Events\NewChatMessage;
use Facades\App\Main\Chat\GetChat;

class CreateNewMessage extends App {

    public function create($data)
    {
        $newMessage = new Message();
        $newMessage->user_id = $this->user()->id;
        $newMessage->chat_id = $data->chat_id;
        $newMessage->message = $data->message;
        $newMessage->save();

        $chat = GetChat::get($data->chat_id);

        $users = json_decode($chat->users);

        $id = 0;

        foreach ($users as $user) {
            if ($user !== $this->user()->id) {
                $id = $user;
            }
        }

        broadcast(new NewChatMessage($newMessage, $id))->toOthers();

        return $this->return($newMessage);
    }

}
