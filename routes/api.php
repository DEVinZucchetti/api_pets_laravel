<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\PeoplesController;
use Illuminate\Support\Facades\Route;

Route::resource('peoples', PeoplesController::class)->only(
  ['index', 'show', 'store', 'update', 'destroy']
);

Route::get('pets', [PetController::class, 'index']);
Route::post('pets', [PetController::class, 'store']);
Route::delete('pets/{id}', [PetController::class, 'destroy']);
Route::get('pets/{id}', [PetController::class, 'show']);
Route::put('pets/{id}', [PetController::class, 'update']);

Route::post('races', [RaceController::class, 'store']);
Route::get('races', [RaceController::class, 'index']);

/*
Route::resource('pets', PetController::class)
  ->only(['index', 'show', 'store', 'update', 'destroy']);
*/

