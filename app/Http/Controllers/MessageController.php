<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Main\Message\GetChatMessages;
use Facades\App\Main\Message\CreateNewMessage;

class MessageController extends Controller
{
    public function get(Request $request)
    {
        return GetChatMessages::get($request->chat_id);
    }

    public function create(Request $request)
    {
        return CreateNewMessage::create($request);
    }
}
