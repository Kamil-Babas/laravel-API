<?php

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => view('index'));

// search pet by ID
Route::get('/pets', [APIController::class, 'searchPetByID']);
// show pets by status
Route::get('/pets/find', [APIController::class, 'showPetsByStatus']);
// create pet view
Route::get('/pets/add', [APIController::class, 'showPetCreateForm']);
// show pet's view
Route::get('/pets/{id}', [APIController::class, 'showPetView']);

// show pet's Edit form
Route::get('/pets/edit/{id}', [APIController::class, 'showPetEditForm']);
// edit pet
Route::put('/pets/edit', [APIController::class, 'editPet'])->name('edit-pet');
// delete pet
Route::delete('/pets/{id}',  [APIController::class, 'deletePet']);

// create pet
Route::post('/pets/add',  [APIController::class, 'createPet']);

