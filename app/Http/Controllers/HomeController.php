<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends PageController 
{
    public function index() {
        return view('pages.home.home');
    }
}