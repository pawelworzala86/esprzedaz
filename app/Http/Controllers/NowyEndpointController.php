<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NowyEndpointController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Witaj na nowym endpointcie!']);
    }
}
