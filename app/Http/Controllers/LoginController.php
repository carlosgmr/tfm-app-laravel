<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    public function get()
    {
        return view('login');
    }

    public function post(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $client = new Client();
        $response = $client->request('POST', env('API_URL').'auth/login', [
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($validatedData),
        ]);

        $apiErrors = [];
        if ($response->getStatusCode() === 200) {
            // guardar datos en sesión
        } else {
            $content = json_decode($response->getBody()->getContents(), true);
            foreach ($content as $row) {
                foreach ($row as $error) {
                    $apiErrors[] = $error;
                }
            }
        }

        return view('login', [
            'apiErrors' => $apiErrors,
        ]);
    }
}