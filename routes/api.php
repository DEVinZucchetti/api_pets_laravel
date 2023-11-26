<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\PeoplesController;
use App\Http\Controllers\ProfessionalsController;

use App\Http\Controllers\SpeciesController;
use Illuminate\Support\Facades\Route;

Route::resource('peoples', PeoplesController::class)->only(
  ['index', 'show', 'store', 'update', 'destroy']
);

Route::resource('pets', PetController::class)->only(
  ['index', 'show', 'store', 'update', 'destroy']
);

Route::resource('clients', ClientsController::class)->except(['create', 'edit']);

Route::prefix('races')->group(function () {
  Route::get('', [RaceController::class, 'index']);
  Route::post('', [RaceController::class, 'store']);
});



Route::resource('professionals', ProfessionalsController::class)->except(['create', 'edit']);
Route::resource('species', SpeciesController::class)->except(['create', 'edit']);

