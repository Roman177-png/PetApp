<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }
    public function create()
    {
        return view('pets.create');
    }
    public function store(StorePetRequest $request)
    {
        $validatedData = $request->validated();
        $data = [
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $validatedData['photoUrls'],
            'tags' => $validatedData['tags'] ?? [],
            'category' => [
                'id' => $validatedData['category_id'] ?? 0,
                'name' => 'string',
            ],
        ];
        $response = $this->petService->addPet($data);
        if ($response) {
            return redirect()->route('pets.index')->with('success', 'Pet added successfully');
        }
        return back()->withErrors(['error' => 'Unable to add pet']);
    }
    public function index()
    {
        $pets = $this->petService->getPetsByStatus('available');
        return view('pets.index', compact('pets'));
    }
    public function show($id)
    {
        $pet = $this->petService->getPetById($id);

        if (!$pet) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Pet not found']);
        }

        return view('pets.show', compact('pet'));
    }
    public function edit($id)
    {
        $pet = $this->petService->getPetById($id);

        if (!$pet) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Pet not found']);
        }

        return view('pets.edit', compact('pet'));
    }
    public function update(StorePetRequest $request, $id)
    {
        $validatedData = $request->validated();

        $data = [
            'id' => $id,
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $validatedData['photoUrls'],
            'tags' => $validatedData['tags'] ?? [],
            'category' => [
                'id' => $validatedData['category_id'] ?? 0,
                'name' => 'string',
            ],
        ];

        $response = $this->petService->updatePet($data);

        if ($response) {
            return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
        }

        return back()->withErrors(['error' => 'Unable to update pet']);
    }

    public function destroy($id)
    {
        $response = $this->petService->deletePet($id);

        if ($response) {
            return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
        }

        return back()->withErrors(['error' => 'Unable to delete pet']);
    }
}
