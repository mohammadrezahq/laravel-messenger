<?php

namespace App\Main;

use Exception;
use Illuminate\Support\Facades\Auth;

class App {

    public function user()
    {
        return Auth::user();
    }

    public function return($data)
    {
        try {
            $data;
        } catch(Exception $e) {
            return $e;
        }

        return $data;
    }

}
