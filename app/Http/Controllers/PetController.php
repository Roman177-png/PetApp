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
        $tags = [];
        if (!empty($validatedData['tags'])) {
            foreach ($validatedData['tags'] as $tag) {
                $tags[] = [
                    'id' => 0,
                    'name' => $tag,
                ];
            }
        }

        $data = [
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $validatedData['photoUrls'],
            'tags' => $tags,
            'category' => [
                'id' => $validatedData['category_id'] ?? 0,
                'name' => 'string',
            ],
        ];

        try {
            $response = $this->petService->addPet($data);

            if (isset($response['id'])) {
                return redirect()->route('pets.index')->with('success', 'Pet added successfully');
            }

            return back()->withErrors(['error' => $response['message'] ?? 'Unable to add pet']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        $status = $request->get('status', 'available');
        $pets = $this->petService->getPetsByStatus($status);

        $filteredPets = array_filter($pets, function ($pet) {
            return isset($pet['name']) && !empty($pet['name']);
        });

        $itemsPerPage = 12;
        $currentPage = request()->get('page', 1);

        $start = ($currentPage - 1) * $itemsPerPage;
        $pagedPets = array_slice($filteredPets, $start, $itemsPerPage);

        $totalPages = ceil(count($filteredPets) / $itemsPerPage);

        return view('pets.index', compact('pagedPets', 'totalPages', 'currentPage'));
    }

    public function show($id)
    {
        try {
            $pet = $this->petService->getPetById($id);

            if (!$pet) {
                return redirect()->route('pets.index')->withErrors(['error' => 'Pet not found']);
            }
            return view('pets.show', compact('pet'));

        } catch (\Exception $e) {
            return redirect()->route('pets.index')->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
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
        $tags = [];
        if (!empty($validatedData['tags'])) {
            foreach ($validatedData['tags'] as $tag) {
                $tags[] = [
                    'id' => 0,
                    'name' => $tag,
                ];
            }
        }
        $data = [
            'id' => $id,
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $validatedData['photoUrls'],
            'tags' => $tags,
            'category' => [
                'id' => $validatedData['category_id'] ?? 0,
                'name' => 'string',
            ],
        ];

        try {
            $response = $this->petService->updatePet($data);
            if (isset($response['id'])){
                return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
            }
            return back()->withErrors(['error' => $response['message'] ?? 'Unable to update pet']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->petService->deletePet($id);

            if ($response && $response['status'] == 200) {
                return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
            }
            return back()->withErrors(['error' => 'Unable to delete pet, try again later.']);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

}
