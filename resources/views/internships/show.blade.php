@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">{{ $internship->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $internship->description }}</p>
                    <p class="text-sm text-gray-600">Location: {{ $internship->location }}</p>
                    <p class="text-sm text-gray-600">Type: {{ $internship->type }}</p>
                    <p class="text-sm text-gray-600">Duration: {{ $internship->duration }}</p>
                    <p class="text-sm text-gray-600">Deadline: {{ $internship->deadline }}</p>

                    @if (auth()->user()->role === 'student')
                        <a href="{{ route('applications.create', $internship) }}"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg mt-6 inline-block">Apply Now</a>
                    @endif

                    @if (auth()->user()->role === 'business')
                        <a href="{{ route('internships.applications', $internship) }}"
                            class="bg-purple-600 text-white px-6 py-2 rounded-lg mt-6 inline-block">View Applications
                            ({{ $internship->applications->count() }})</a>
                    @endif

                    <a href="{{ route('internships.index') }}" class="bg-gray-300 text-gray-600 px-6 py-2 rounded-lg ml-6">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
