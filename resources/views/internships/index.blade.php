@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Internships</h2>
                        @auth
                            @if(auth()->user()->role === 'business')
                                <a href="{{ route('internships.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">+
                                    Post Internship</a>
                            @endif
                        @endauth
                    </div>

                    <form method="GET" action="{{ route('internships.index') }}" class="mb-6">
                        <div class="grid md:grid-cols-4 gap-4">
                            <input type="text" name="search" placeholder="Search by title or location"
                                value="{{ request('search') }}" class="border rounded-lg p-2">
                            <select name="type" class="border rounded-lg p-2">
                                <option value="">All Types</option>
                                <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="onsite" {{ request('type') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                                <option value="hybrid" {{ request('type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                            <select name="duration" class="border rounded-lg p-2">
                                <option value="">All Durations</option>
                                <option value="3 months" {{ request('duration') == '3 months' ? 'selected' : '' }}>3 months
                                </option>
                                <option value="6 months" {{ request('duration') == '6 months' ? 'selected' : '' }}>6 months
                                </option>
                            </select>
                            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg">Apply Filter</button>
                        </div>
                    </form>

                    <div class="space-y-4">
                        @forelse($internships as $internship)
                            <div class="border p-4 rounded-lg">
                                <h3 class="text-xl font-semibold">{{ $internship->title }}</h3>
                                <p class="text-gray-600 mt-2">{{ Str::limit($internship->description, 150) }}</p>
                                <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                    <span>Location: {{ $internship->location }}</span>
                                    <span>Type: {{ ucfirst($internship->type) }}</span>
                                    <span>Duration: {{ $internship->duration }}</span>
                                </div>
                                <a href="{{ route('internships.show', $internship) }}"
                                    class="text-blue-600 mt-2 inline-block">View Details
                                    <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-500">No internships found.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}"
                            class="bg-gray-300 text-gray-600 px-6 py-2 rounded-lg inline-block">Back to Dashboard</a>
                    </div>

                    {{ $internships->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection