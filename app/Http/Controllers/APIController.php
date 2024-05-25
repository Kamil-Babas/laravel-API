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

    //fetch pet by ID
    private function fetchPet($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return ['errorMessage' => 'Invalid ID supplied must be an integer at least 1'];
        }

        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");

        switch ($response->status()) {
            case 200:
                return ['pet' => $response->json()];
            case 400:
                return ['errorMessage' => 'Invalid ID supplied'];
            case 404:
                return ['errorMessage' => 'Pet not found'];
            default:
                abort($response->status(), 'An error occurred');
        }
    }

    public function showPetView($id) {

        $data = $this->fetchPet($id);
        return view('pet.petView', $data);

    }

    public function showPetEditForm($id){

        $data = $this->fetchPet($id);
        return view('pet.petEditForm', $data);

    }

    public function editPet(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required|int',
            'category_name' => 'string|max:255',
            'name' => 'required|string|max:255',
            'photoUrls' => 'required|string',
        ]);

        $photoUrls = explode(';', $validatedData['photoUrls']);

        $petData = [
            'id' => $validatedData['id'],
            'category' => [
                'id' => 0,
                'name' => $validatedData['category_name'] ?? 'default-category-name',
            ],
            'name' => $validatedData['name'],
            'photoUrls' => $photoUrls
        ];


        $response = Http::put("https://petstore.swagger.io/v2/pet", $petData);

        switch ($response->status()) {
            case 200:
                return redirect('/')->with('message', 'Pet updated successfully!');
            case 400:
                return redirect()->back()->withErrors(['errorMessage' => 'Invalid ID supplied']);
            case 404:
                return redirect()->back()->withErrors(['errorMessage' => 'Pet not found']);
            case 405:
                return redirect()->back()->withErrors(['errorMessage' => 'Validation exception']);
            default:
                return redirect()->back()->withErrors(['errorMessage' => 'An error occurred']);
        }


    }

    public function deletePet($id) {

        $response = Http::delete("https://petstore.swagger.io/v2/pet/{$id}");

        switch ($response->status()) {
            case 200:
                return redirect('/')->with('message', 'Pet deleted successfully!');
            case 400:
                return redirect()->back()->withErrors(['errorMessage' => 'Invalid ID supplied']);
            case 404:
                return redirect()->back()->withErrors(['errorMessage' => 'Pet not found']);
            default:
                return redirect()->back()->withErrors(['errorMessage' => 'An error occurred']);
        }

    }

}
