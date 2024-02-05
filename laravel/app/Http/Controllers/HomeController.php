<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home()
    {
        // Landing del backend
        return view('home.home');
    }
}
