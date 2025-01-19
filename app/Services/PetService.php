<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class PetService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('petstore.api_url');
    }

    public function getPetById($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");
        return $response->successful() ? $response->json() : null;
    }
    public function getPetsByStatus($status)
    {
        $response = Http::get("{$this->apiUrl}/findByStatus", [
            'status' => $status
        ]);
        return $response->successful() ? $response->json() : [];
    }
    public function addPet($data)
    {
        $response = Http::post($this->apiUrl, $data);
        return $response->successful() ? $response->json() : null;
    }
    public function updatePet($data)
    {
        $response = Http::put($this->apiUrl, $data);
        return $response->successful() ? $response->json() : null;
    }

    public function deletePet($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");
        return $response->successful();
    }
}
