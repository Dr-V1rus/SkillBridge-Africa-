@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Manage Applications</h2>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 px-4 py-2 rounded-lg">Back</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($applications as $application)
                            <div class="border p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $application->internship->title ?? 'Unknown' }}</p>
                                        <p class="text-sm text-gray-600">Student: {{ $application->student->name ?? 'Unknown' }}
                                        </p>
                                        <p class="text-sm text-gray-600">Status:
                                            <span
                                                class="px-2 py-1 text-xs rounded 
                                                    {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                                    {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </p>
                                        <p class="text-gray-700 mt-2">{{ Str::limit($application->message, 100) }}</p>
                                        <p class="text-xs text-gray-500">Applied:
                                            {{ $application->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No applications found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection