@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Internships</h2>
                    
                    @if(auth()->user()->role === 'business')
                        <a href="{{ route('internships.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg mb-6 inline-block">Post Internship</a>
                    @endif

                    <div class="grid gap-6">
                        @foreach($internships as $internship)
                            <div class="border p-4 rounded-lg">
                                <h3 class="text-xl font-semibold">{{ $internship->title }}</h3>
                                <p class="text-gray-600 mt-2">{{ $internship->description }}</p>
                                <p class="text-sm text-gray-500 mt-2">Location: {{ $internship->location }} | Type: {{ $internship->type }} | Duration: {{ $internship->duration }}</p>
                                <a href="{{ route('internships.show', $internship) }}" class="text-blue-600 mt-2 inline-block">View Details</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection