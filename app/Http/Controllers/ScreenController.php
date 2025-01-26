<?php

namespace App\Http\Controllers;

class ScreenController extends Controller
{
    public function screenOne()
    {
        return view('screenOne');
    }

    public function screenTwo()
    {
        return view('screenTwo');
    }

    public function screenThree()
    {
        return view('screenThree');
    }

}
