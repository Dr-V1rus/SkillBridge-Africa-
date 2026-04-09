@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Student Dashboard</h2>

                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Your Applications</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $applications->count() }}</p>
                            <a href="{{ route('applications.index') }}" class="text-blue-600 mt-2 inline-block">View All
                                →</a>
                        </div>
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Available Internships</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $internshipsCount }}</p>
                            <a href="{{ route('internships.index') }}" class="text-green-600 mt-2 inline-block">Browse →</a>
                        </div>
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Recent Applications</h3>
                    <div class="space-y-4">
                        @forelse($applications->take(5) as $application)
                            <div class="border p-4 rounded-lg">
                                <p class="font-semibold">{{ $application->internship->title }}</p>
                                <p class="text-sm text-gray-600">Applied to {{ $application->internship->business->name }}
                                </p>
                                <span class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500">No applications yet. Start browsing internships!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
