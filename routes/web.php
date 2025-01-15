<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularzController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AddPetController;



Route::get('/', function () {
    return view('welcome');
});


//Route::get('/nowy-endpoint', [NowyEndpointController::class, 'index']);
Route::get('/nowy-endpoint', function () {
    return view('welcome');
});

Route::post('/formularz', [FormularzController::class, 'store']);
Route::get('/formularz', function () { return view('formularz'); });

Route::get('/logowanie', function () { return view('login'); });
Route::post('/api/user/login', [LoginController::class, 'login']);




Route::get('/sklep', [ShopController::class, 'showTable']);
Route::get('/sklep/dodaj', function () { return view('addPet'); });
Route::post('/api/pets', [AddPetController::class, 'add']);