<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{

    //fetch pet by ID
    public function fetchPet($id)
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
                return ['errorMessage' => 'An error occurred'];
        }

    }


    public function fetchPetsByStatus($status)
    {

        $response = Http::get("https://petstore.swagger.io/v2/pet/findByStatus?status={$status}");

        switch ($response->status()) {
            case 200:
                return ['pets' => $response->json()];
            case 400:
                return ['errorMessage' => 'Invalid status value'];
            default:
                return ['errorMessage' => 'An error occurred'];
        }

    }


    public function editPet(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required|int',
            'category_name' => 'nullable|string|max:255',
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


    public function createPet(Request $request) {

        $validatedData = $request->validate([
            'category_name' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'photoUrls' => 'required|string',
            'status' => 'nullable|string|in:available,pending,sold'
        ]);

        $photoUrls = explode(';', $validatedData['photoUrls']);

        $petData = [
            'category' => [
                'id' => 0,
                'name' => $validatedData['category_name'] ?? 'default-category-name',
            ],
            'name' => $validatedData['name'],
            'photoUrls' => $photoUrls,
            'tags' => [
                [
                'id' => 0,
                'name' => 'string'
                ]
            ],
            'status' => $validatedData['status'] ?? ''
        ];

        $response = Http::post('https://petstore.swagger.io/v2/pet', $petData);

        switch ($response->status()) {
            case 200:
                return redirect("/pets/{$response->json('id')}")->with('successMessage', 'Pet created successfully!');
            case 405:
                return redirect()->back()->withErrors(['errorMessage' => 'Invalid input']);
            default:
                return redirect()->back()->withErrors(['errorMessage' => 'An error occurred']);
        }

    }


    public function uploadImage(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required|int',
            'file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'additional_data' => 'nullable|string'
        ]);

        $file = $request->file('file');

        $httpRequest = Http::attach(
            'file',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->asMultipart();

        if(!empty($validatedData['additionalMetadata'])) {
            $httpRequest = $httpRequest->withOptions([
                'form_params' => [
                    'additionalMetadata' => $validatedData['additionalMetadata'],
                ],
            ]);
        }

        $petId = $request->id;
        $response = $httpRequest->post("https://petstore.swagger.io/v2/pet/{$petId}/uploadImage");

        switch ($response->status()) {
            case 200:
                return redirect("/")->with('message', 'Image uploaded successfully!');
            default:
                return redirect()->back()->withErrors(['errorMessage' => 'An error occurred']);
        }

    }

}
