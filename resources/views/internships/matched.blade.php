@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Matched Internships</h2>
                    <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-600 px-4 py-2 rounded-lg">Back to Dashboard</a>
                </div>
                
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-gray-700"><strong>Your Skills:</strong> {{ $studentSkills ?: 'Not specified' }}</p>
                    <p class="text-xs text-gray-500 mt-1">Update your skills in your profile to get better matches</p>
                </div>
                
                @if($internships->count() > 0)
                    <div class="space-y-4">
                        @foreach($internships as $match)
                            <div class="border p-4 rounded-lg hover:shadow-lg transition">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold">{{ $match['internship']->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $match['internship']->business->name }}</p>
                                        <p class="text-gray-600 mt-2">{{ Str::limit($match['internship']->description, 150) }}</p>
                                        <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $match['internship']->location }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                {{ ucfirst($match['internship']->type) }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $match['internship']->duration }}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="text-sm font-semibold">Matched skills:</span>
                                            @foreach($match['matched_skills'] as $skill)
                                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded ml-1">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-blue-600">{{ $match['match_percentage'] }}%</span>
                                        <p class="text-xs text-gray-500">Match</p>
                                        <a href="{{ route('internships.show', $match['internship']) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-2 inline-block hover:bg-blue-700">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $internships->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">No matching internships found.</p>
                        <p class="text-sm text-gray-400 mt-2">Update your skills in your profile or browse all internships.</p>
                        <a href="{{ route('internships.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg mt-4">Browse All Internships</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
