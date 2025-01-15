<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ShopController extends Controller
{
    public function showTable()
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available'); 
        $pets = $response->json();

        //var_dump($resp);
        foreach($pets as $key=>$pet){
            $pets[$key]['name'] = substr($pet['name']??'', 0, 64);
        }

        //usunąłem petsy bez name albo name=''
        $pets = array_filter($pets, function($element){
            return strlen($element['name']??''); 
        });

        return view('shop', ['pets' => $pets]);
    }
}
