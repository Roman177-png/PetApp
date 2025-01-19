<?php

namespace App\Http\Controllers;

use App\Services\PetService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }
    public function index()
    {
        $pets = $this->petService->getPetsByStatus('available');
        dd($pets);
        return view('welcome');
    }
}
