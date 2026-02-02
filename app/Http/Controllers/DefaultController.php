<?php

namespace App\Http\Controllers;

class DefaultController extends Controller
{
    function home() 
    { 
      return view('default.home');
    }
}