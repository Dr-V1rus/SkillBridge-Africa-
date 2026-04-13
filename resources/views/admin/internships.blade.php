@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Manage Internships</h2>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 px-4 py-2 rounded-lg">Back</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($internships as $internship)
                            <div class="border p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $internship->title }}</p>
                                        <p class="text-sm text-gray-600">Business:
                                            {{ $internship->business->name ?? 'Unknown' }}</p>
                                        <p class="text-sm text-gray-600">Location: {{ $internship->location }} | Type:
                                            {{ $internship->type }}</p>
                                        <p class="text-xs text-gray-500">Posted: {{ $internship->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                    <form method="POST" action="{{ route('admin.internship.delete', $internship) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm"
                                            onclick="return confirm('Delete this internship?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No internships found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection