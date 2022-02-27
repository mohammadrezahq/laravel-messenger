<?php

namespace App\Main\Friend;

use App\Main\App;
use App\Models\Friend;
use Facades\App\Main\User\GetUser;

class CreateNewFriend extends App
{

    public function create($data)
    {
        $user = GetUser::getByEmail($data->email);

        if (!$user) {
            return "USER does not exist.";
        }

        $friend = Friend::whereJsonContains('users', $this->user()->id)->whereJsonContains('users', $user->id)->first();

        if ($friend) {
            return "FRIENDSHIP does not exist.";
        }

        $friend = new Friend();
        $friend->users = json_encode([$this->user()->id, $user->id]);
        $friend->data = json_encode(['pending' => $user->id]);
        $friend->status = 'pending';
        $friend->save();

        return $friend;
    }

}
