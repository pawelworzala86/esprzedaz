<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FormularzController extends Controller
{
    public function store(Request $request)
    {
        // Walidacja danych
        $validatedData = $request->validate([
            'nazwa_pola' => 'required|string|max:255',
            // Dodaj inne reguły walidacji dla innych pól formularza
        ]);

        $response = Http::post('https://petstore.swagger.io/v2/user', [ 
            "id" => 0,
            "username" => "pawelworzala86",
            "firstName"=>"Paweł",
            "lastName"=> "Worzała",
            "email"=> "pawelworzala86@gmail.com",
            "password"=> "testABC",
            "phone"=>"666925387",
            "userStatus"=> 0,
        ]); 
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
