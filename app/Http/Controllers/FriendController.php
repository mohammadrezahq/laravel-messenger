<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Main\Friend\UpdateFriend;
use Facades\App\Main\Friend\CreateNewFriend;

class FriendController extends Controller
{
    public function create(Request $request)
    {
        return CreateNewFriend::create($request);
    }

    public function update(Request $request)
    {
        return UpdateFriend::update($request);
    }
}
