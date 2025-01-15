<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EditPetController extends Controller
{
    public function editPet($id=null){

        $resp = [
            'id'=>'',
            'name'=>'',
        ];

        if($id){
            $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
            $resp = $response->json();
            //var_dump($resp);
        }

        return view('editPet', ['pet' => $resp]);
    }

    public function addPet(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'integer',
            'name' => 'required|string|max:255',
        ]);

        $dataset = [
            "id"=> $validatedData['id']??0,
            "category"=> [
                "id"=> 0,
                "name"=> "string"
            ],
            "name"=> $validatedData['name'],
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
        ];

        $method = 'post';
        if(strlen($validatedData['id'])){
            $method = 'put';

            //$dataset['name'] = $validatedData['name'];
        }
        //var_dump($validatedData);
        //exit;

        $response = Http::{$method}('https://petstore.swagger.io/v2/pet',$dataset); 
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
