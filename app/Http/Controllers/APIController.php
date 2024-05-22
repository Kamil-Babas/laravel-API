<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function searchPetByID(Request $request){

        $request->validate([
            'pet_id' => 'required|integer|min:1'
        ]);

        $id = $request['pet_id'];

        return redirect("/pets/{$id}"); // przekierowuje do showPetView()

    }

    public function showPetView($id)
    {
        // nie udalo mi sie uzyskac kodu 400 bezposrednio z api, zawsze jest to 404 dlatego zaimplementowalem ponizsza logike
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return view('pet.petView')->with('errorMessage', '	Invalid ID supplied must be Integer at least 1');
        }
        //end


        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");

        switch ($response->status()) {

            case 200:
                $pet = $response->json();
                return view('pet.petView', compact('pet'));

            case 400:
                return view('pet.petView')->with('errorMessage', '	Invalid ID supplied');
                // abort(400, 'Invalid ID supplied');

            case 404:
                return view('pet.petView')->with('errorMessage', 'Pet not found');
              // abort(404, 'Pet not found');

            default:
                abort($response->status(), 'An error occurred');
        }

    }

    public function showPetEditForm(){
        return view('pet.petEditForm');
    }

}
