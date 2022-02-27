<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Facades\App\Main\Chat\GetUserChats;
use Facades\App\Main\Friend\GetUserFriends;

class PageController extends Controller
{
    public function home()
    {
        $chats = GetUserChats::get();
        return Inertia::render('Home', ['chats' => $chats]);
    }

    public function friends()
    {
        $friends = GetUserFriends::get();
        return Inertia::render('Friends', ['friends' => $friends]);
    }
}
