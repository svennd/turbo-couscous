<?php

namespace App\Controllers;

class Ping extends BaseController
{
    public function index()
    {
        echo "mohow";
        return view('welcome_message');
    }
}
