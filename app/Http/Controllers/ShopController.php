<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ShopController extends Controller
{
    public function showTable()
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available'); 
        $resp = $response->json();

        //var_dump($resp);

        return view('shop', ['pets' => $resp]);
    }
}
