<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listing(Request $request)
    {
        return view('administrator.home');
    }

    public function read(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function createView(Request $request)
    {
        return view('administrator.home');
    }

    public function createProcess(Request $request)
    {
        return view('administrator.home');
    }

    public function updateView(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function updateProcess(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function deleteView(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function deleteProcess(Request $request, $id)
    {
        return view('administrator.home');
    }
}