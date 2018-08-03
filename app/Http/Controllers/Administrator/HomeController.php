<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('administrator.home');
    }
}