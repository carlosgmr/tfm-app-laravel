<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('instructor.home');
    }
}