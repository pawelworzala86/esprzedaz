<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class PetsController extends Controller
{
    public function table($status=null,$category=null)
    {
        if(!strlen($status)||($status==null)){
            $status = 'dostepne';
        }
        //var_dump($status);
        if($status=='oczekujace'){
            $status = 'pending';
        }else if($status=='dostepne'){
            $status = 'available';
        }else if($status=='sprzedane'){
            $status = 'sold';
        }else{
            return view('error', ['error' => [
                'message'=>'Nieznany status pozycji w sklepie!',
            ]]);
        }

        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status='.$status); 
        $pets = $response->json();

        foreach($pets as $key=>$pet){
            $pets[$key]['name'] = substr($pet['name']??'', 0, 64);
            $pets[$key]['category']['name'] = substr($pet['category']['name']??'', 0, 32);
        }

        if(strlen($category)&&$category){
            $pets = array_filter($pets, function($pet)use($category){
                $cat = $pet['category']??[];
                $cat = $cat['name']??'';
                //var_dump([$cat,$category]);
                return $cat==$category;
            });
        }

        if($status=='pending'){
            $status = 'oczekujace';
        }else if($status=='available'){
            $status = 'dostepne';
        }else if($status=='sold'){
            $status = 'sprzedane';
        }

        return view('pets', ['pets' => $pets,'status'=>$status,'category'=>$category]);
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
            'status'=>'',
        ];

        if($id){
            $response = Http::get('https://petstore.swagger.io/v2/pet/'.$id);
            $resp = $response->json();

            if (!$response->successful()) {
                return view('error', ['error' => [
                    'message'=>'Nie odnaleziono zwierzaka w bazie!',
                ]]);
            }

            //var_dump($resp);
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
            'status' => 'required|string|max:255',
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

        if(($validatedData['status']!='available')&&($validatedData['status']!='pending')){
            return view('error', ['error' => [
                'message'=>'Nieznany status!',
            ]]); 
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
            "status"=> $validatedData['status'],
        ];

        $method = 'post';
        if(strlen($validatedData['id'])){
            $method = 'put';
        }

        $response = Http::{$method}('https://petstore.swagger.io/v2/pet',$dataset); 
        $resp = $response->json();

        if ($response->successful()) { 
            //echo "Request was successful!";
            header('Location: /sklep');
            exit;
        } else { 
            return view('error', ['error' => [
                'message'=>'Błąd połączenia z API!',
            ]]); 
        }

        return response()->json(['message' => 'Dane zostały zapisane pomyślnie!']);
    }
    public function deletePet($id)
    {
        $response = Http::delete('https://petstore.swagger.io/v2/pet/'.$id); 
        $resp = $response->json();

        if ($response->successful()) {
            header('Location: /sklep');
            exit;
        } else { 
            return view('error', ['error' => [
                'message'=>'Błąd połączenia z API!',
            ]]); 
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
