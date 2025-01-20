@extends('layouts.app')

@section('title', 'Pet List')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Available Pets</h2>

        <form action="{{ route('pets.index') }}" method="GET" class="mb-6">
            <label for="status" class="text-lg font-semibold">Filter by Status:</label>
            <select name="status" id="status" class="border rounded px-4 py-2">
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
            <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
        </form>

        <a href="{{ route('pets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6 inline-block">
            Add New Pet
        </a>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($pagedPets as $pet)
                <div class="border p-4 rounded-lg shadow-sm bg-gray-50">
                    <h3 class="text-xl font-semibold">{{ $pet['name'] }}</h3>
                    <p>Status: <span class="text-blue-600">{{ $pet['status'] }}</span></p>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('pets.show', $pet['id']) }}" class="text-blue-600 hover:underline">Details</a>
                        <a href="{{ route('pets.edit', $pet['id']) }}" class="text-green-600 hover:underline">Edit</a>
                        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 mx-auto w-full max-w-4xl">
            <nav aria-label="Page navigation example">
                <ul class="flex items-center -space-x-px h-8 text-sm justify-center">
                    @if ($currentPage == 1)
                        <li class="disabled">
                            <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 cursor-not-allowed rounded-s-lg">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('pets.index', ['page' => $currentPage - 1, 'status' => request('status')]) }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li>
                            <a href="{{ route('pets.index', ['page' => $i, 'status' => request('status')]) }}" class="flex items-center justify-center px-3 h-8 leading-tight {{ $i == $currentPage ? 'text-blue-600 border border-blue-300 bg-blue-50' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    @if ($currentPage < $totalPages)
                        <li>
                            <a href="{{ route('pets.index', ['page' => $currentPage + 1, 'status' => request('status')]) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="disabled">
                            <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-e-lg">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
