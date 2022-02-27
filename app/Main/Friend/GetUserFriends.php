<?php

namespace App\Main\Friend;

use App\Main\App;
use App\Models\User;
use App\Models\Friend;

class GetUserFriends extends App {

    public function get()
    {
        $friends = Friend::whereJsonContains('users', $this->user()->id)->get();

        foreach($friends as $key => $value) {

            $check = explode(',', $value->users);
            foreach($check as $key2 => $value2) {
                if ($value !== $this->user()->id) {
                    $friends[$key]->user = User::select('id' , 'name' , 'profile_photo_path')->where('id', $value2)->first();
                }
            }

        }
        return $this->return($friends);
    }

}
