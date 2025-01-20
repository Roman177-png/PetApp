@extends('layouts.app')

@section('title', 'Edit Pet')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit Pet</h2>

        <form action="{{ route('pets.update', $pet['id']) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-gray-700 font-semibold">Pet Name</label>
                <input type="text" name="name" id="name" value="{{ $pet['name'] }}" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="status" class="block text-gray-700 font-semibold">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="available" @if($pet['status'] == 'available') selected @endif>Available</option>
                    <option value="pending" @if($pet['status'] == 'pending') selected @endif>Pending</option>
                    <option value="sold" @if($pet['status'] == 'sold') selected @endif>Sold</option>
                </select>
            </div>

            <div>
                <label for="photoUrls" class="block text-gray-700 font-semibold">Photo URLs</label>
                <input type="text" name="photoUrls[]" id="photoUrls" value="{{ implode(',', $pet['photoUrls']) }}" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('pets.index') }}" class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300">
                    Back
                </a>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
