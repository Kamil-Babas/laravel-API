<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    private APIController $apiController;

    public function __construct(APIController $apiController)
    {
        $this->apiController = $apiController;
    }

    public function searchPetByID(Request $request){

        $request->validate([
            'pet_id' => 'required|integer|min:1'
        ]);

        $id = $request['pet_id'];

        return redirect("/pets/{$id}"); // przekierowuje do showPetView()

    }

    public function showPetView($id)
    {
        $data = $this->apiController->fetchPet($id);
        return view('pet.petView', $data);
    }

    public function showPetsByStatus(Request $request){

        $validator = Validator::make(['pet_status' => $request['pet_status']], [
            'pet_status' => 'required|string|in:available,pending,sold'
        ]);

        if ($validator->fails()) {
            return redirect('/')->withErrors(['pet_status' => 'Invalid status']);
        }

        $petStatus = $request['pet_status'];
        $data = $this->apiController->fetchPetsByStatus($petStatus);

        return view('pet.petsView', $data);
    }


    public function showPetCreateForm()
    {
        return view('pet.createPetView');
    }

    public function showPetEditForm($id)
    {
        $data = $this->apiController->fetchPet($id);
        return view('pet.petEditForm', $data);
    }


    public function showUploadImageForm($id)
    {
        $data = $this->apiController->fetchPet($id);
        return view('pet.uploadImageView', $data);
    }

}
