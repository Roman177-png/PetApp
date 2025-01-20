@extends('layouts.app')

@section('title', 'Pet Details')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ $pet['name'] }}</h2>
        <p>Status: <span class="text-blue-600">{{ $pet['status'] }}</span></p>
        <p>Photo URLs:</p>
        <ul>
            @foreach ($pet['photoUrls'] as $url)
                <li><a href="{{ $url }}" target="_blank" class="text-blue-600 hover:underline">{{ $url }}</a></li>
            @endforeach
        </ul>
        <a href="{{ route('pets.index') }}" class="text-blue-600 hover:underline mt-4 block">Back to List</a>
    </div>
@endsection
