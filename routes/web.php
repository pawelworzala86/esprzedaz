<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PetsController;


Route::get('/', [PetsController::class, 'table']);
Route::get('/sklep', [PetsController::class, 'table']);
Route::get('/sklep/dodaj', [PetsController::class, 'editPet']);
Route::get('/sklep/edycja/{id}', [PetsController::class, 'editPet']);
Route::post('/api/pets', [PetsController::class, 'addPet']);
Route::get('/sklep/usun/{id}', [PetsController::class, 'deletePetDialog']);
Route::get('/sklep/usun/{id}/confirm', [PetsController::class, 'deletePet']);