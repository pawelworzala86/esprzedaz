<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class PetsController extends Controller
{
    public function table()
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available'); 
        $pets = $response->json();

        //var_dump($resp);
        foreach($pets as $key=>$pet){
            $pets[$key]['name'] = substr($pet['name']??'', 0, 64);
            $pets[$key]['category']['name'] = substr($pet['category']['name']??'', 0, 32);
        }

        //usunąłem pet'sy bez name albo name=''
        $pets = array_filter($pets, function($element){
            return strlen($element['name']??''); 
        });

        return view('pets', ['pets' => $pets]);
    }
    public function editPet($id=null){

        $resp = [
            'id'=>'',
            'name'=>'',
            'category'=>[
                'id'=>0,
                'name'=>'',
            ],
            'tags'=>'',
        ];

        if($id){
            $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
            $resp = $response->json();

            if (!$response->successful()) {
                return view('error', ['error' => [
                    'message'=>'Nie odnaleziono zwierzaka w bazie!',
                ]]);
            }

            var_dump($resp);
            $tags = [];
            foreach($resp['tags'] as $tag){
                $tags[] = $tag['name'];
            }
            $resp['tags'] = join(',',$tags);
        }

        return view('editPet', ['pet' => $resp]);
    }

    public function addPet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'tags' => 'required|string|max:1024',
        ]);
        if ($validator->fails()) { throw new ValidationException($validator); }
        $validatedData = $validator->validated();

        $tags = explode(',',$validatedData['tags']);
        foreach($tags as $key=>$tag){
            $tags[$key] = [
                'id'=>0,
                'name'=>$tag,
            ];
        }

        $dataset = [
            "id"=> $validatedData['id']??0,
            "category"=> [
                "id"=> 0,
                "name"=> $validatedData['category']
            ],
            "name"=> $validatedData['name'],
            "photoUrls"=> [
                "string"
            ],
            "tags"=> $tags,
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

        //var_dump($resp);

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
    public function deletePet($id)
    {
        $response = Http::delete('https://petstore.swagger.io/v2/pet/'.$id); 
        $resp = $response->json();

        //var_dump($resp);

        if ($response->successful()) { 
            //echo "Request was successful!";
            header('Location: /sklep');
            exit;
        } else { 
            echo "Request failed!"; 
        }

        return response()->json(['message' => 'Dane zostały zapisane pomyślnie!']);
    }
    public function deletePetDialog($id=null){

        $pet = [
            'id'=>$id,
        ];

        return view('deletePetDialog', ['pet' => $pet]);
    }
}
