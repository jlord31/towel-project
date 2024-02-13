<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    function login() 
    {
        
    }

    function dashboard() 
    {
        return view("dashboard");
    }
}
