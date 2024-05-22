<?php

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => view('index'));

// search pet by ID
Route::get('/pets', [APIController::class, 'searchPetByID']);
// show pet
Route::get('/pets/{id}', [APIController::class, 'showPetView']);
// show Edit form
Route::get('/pets/edit/{id}', [APIController::class, 'showPetEditForm']);
