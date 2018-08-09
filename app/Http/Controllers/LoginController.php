<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Api\AuthService;

class LoginController extends Controller
{
    public function get()
    {
        return view('login');
    }

    public function post(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $authService = new AuthService();
        $serviceResponse = $authService->login($data);
        $apiErrors = [];

        if ($serviceResponse->isOk()) {
            $responseData = $serviceResponse->getData();
            $role = $responseData['user']['role'];
            session(['appUser' => $responseData['user']]);
            session(['token' => $responseData['token']]);

            return redirect()->route($role.'.home');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route('login')
                ->withInput($request->except('password'))
                ->withErrors($apiErrors);
    }
}