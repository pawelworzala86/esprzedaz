<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularzController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\PetsController;



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




Route::get('/sklep', [PetsController::class, 'table']);
//Route::get('/sklep/dodaj', function () { return view('addPet'); });
Route::get('/sklep/dodaj', [PetsController::class, 'editPet']);
Route::get('/sklep/edycja/{id}', [PetsController::class, 'editPet']);
Route::post('/api/pets', [PetsController::class, 'addPet']);
Route::get('/sklep/usun/{id}', [PetsController::class, 'deletePetDialog']);
Route::get('/sklep/usun/{id}/confirm', [PetsController::class, 'deletePet']);