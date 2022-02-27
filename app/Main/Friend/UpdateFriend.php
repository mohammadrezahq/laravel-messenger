<?php

namespace App\Main\Friend;

use App\Main\App;
use App\Models\Friend;
use Facades\App\Main\Chat\CreateNewChat;

class UpdateFriend extends App {

    public function update($data)
    {
        $friend = Friend::whereJsonContains('users', $this->user()->id)->whereJsonContains('users', $data->id);
        $getFriend = $friend->first();

        if (!$getFriend) {
            return false;
        }

        if ($data->action == 'accept') {
            CreateNewChat::create($getFriend->users);
            return $friend->update(['status' => 'accepted']);
        }
    }

}
