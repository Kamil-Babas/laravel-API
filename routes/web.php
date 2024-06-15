<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => view('index'));

// search pet by ID
Route::get('/pets', [PetController::class, 'searchPetByID']);
// show pets by status
Route::get('/pets/find', [PetController::class, 'showPetsByStatus']);

// create pet view
Route::get('/pets/add', [PetController::class, 'showPetCreateForm']);
// show pet's view
Route::get('/pets/{id}', [PetController::class, 'showPetView']);

// show pet's Edit form
Route::get('/pets/edit/{id}', [PetController::class, 'showPetEditForm']);
// edit pet
Route::put('/pets/edit', [APIController::class, 'editPet'])->name('edit-pet');
// delete pet
Route::delete('/pets/{id}',  [APIController::class, 'deletePet']);

// create pet
Route::post('/pets/add',  [APIController::class, 'createPet']);
// show upload image form
Route::get('/pets/upload-image/{id}', [PetController::class, 'showUploadImageForm']);
// upload image
Route::post('/pets/upload-image', [APIController::class, 'uploadImage']);
