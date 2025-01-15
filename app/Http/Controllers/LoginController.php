<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $response = Http::get('https://petstore.swagger.io/v2/user/login?username=pawelworzala86&password=testABC'); 
        $resp = $response->json();

        $sessid = explode(':', $resp['message'])[1];

        echo $sessid;

        if ($response->successful()) { 
            echo "Request was successful!"; 
        } else { 
            echo "Request failed!"; 
        }

        // Przetwarzanie danych
        // Na przykład, zapisanie w bazie danych
        // Model::create($validatedData);

        return response()->json(['message' => 'Dane zostały zapisane pomyślnie!']);
    }
}
