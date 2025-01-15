<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddPetController extends Controller
{
    public function editPet($id=null){

        $resp = [];

        if($id){
            $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
            $resp = $response->json();
            var_dump($resp);
        }

        return view('addPet', ['pets' => $resp]);
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $response = Http::post('https://petstore.swagger.io/v2/pet',[
            "id"=> 0,
            "category"=> [
                "id"=> 0,
                "name"=> "string"
            ],
            "name"=> "doggie Turbo",
            "photoUrls"=> [
                "string"
            ],
            "tags"=> [
                [
                    "id"=> 0,
                    "name"=> "string"
                ]
            ],
            "status"=> "available"
        ]); 
        $resp = $response->json();

        var_dump($resp);

        if ($response->successful()) { 
            echo "Request was successful!";
            header('Location: /sklep');
            exit;
        } else { 
            echo "Request failed!"; 
        }

        // Przetwarzanie danych
        // Na przykład, zapisanie w bazie danych
        // Model::create($validatedData);

        return response()->json(['message' => 'Dane zostały zapisane pomyślnie!']);
    }
}
