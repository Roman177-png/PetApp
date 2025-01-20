@extends('layouts.app')

@section('title', 'Edit Pet')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit Pet</h2>
        <form action="{{ route('pets.update', $pet['id']) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-gray-700 font-semibold">Pet Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $pet['name']) }}" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-gray-700 font-semibold">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="available" {{ old('status', $pet['status']) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="pending" {{ old('status', $pet['status']) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sold" {{ old('status', $pet['status']) == 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
                @error('status')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="photoUrls" class="block text-gray-700 font-semibold">Photo URLs</label>
                <input type="text" name="photoUrls[]" id="photoUrls" value="{{ old('photoUrls.0', implode(',', $pet['photoUrls'])) }}" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('photoUrls.*')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="tags" class="block text-gray-700 font-semibold">Tags</label>
                <input type="text" name="tags[]" id="tags"
                       value="{{ old('tags.0', isset($pet['tags'][0]['name']) ? $pet['tags'][0]['name'] : '') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('tags.*')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
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

        @if ($errors->has('error'))
            <div class="mt-4 text-red-500">{{ $errors->first('error') }}</div>
        @endif
    </div>
@endsection
