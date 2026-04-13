@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-6">My Applications</h2>
                        <a href="{{ route('dashboard') }}" class="bg-gray-300 rounded-xl mb-4 py-2 px-4 text-gray-600">Back</a>
                    </div>

                    @forelse($applications as $application)
                        <div class="border p-4 rounded-lg mb-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="font-semibold">{{ $application->internship->title }}</p>
                                    <p class="text-sm text-gray-600">Company: {{ $application->internship->business->name }}</p>
                                    <p class="text-sm text-gray-600">Applied: {{ $application->created_at->format('M d, Y') }}
                                    </p>
                                    <span
                                        class="inline-block px-2 py-1 text-xs rounded mt-2 
                                        {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                    <p class="text-gray-700 mt-2">{{ $application->message }}</p>
                                    
                                    @if($application->portfolio_link)
                                        <a href="{{ $application->portfolio_link }}" target="_blank"
                                            class="bg-gray-300 w-40 rounded-xl py-2 px-4 text-blue-600 text-sm mt-2 inline-block text-center">View Portfolio
                                            <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    @if($application->cv_path)
                                        <div class="mt-3">
                                            <p class="text-sm font-semibold mb-1">CV Preview:</p>
                                            <iframe src="{{ asset('storage/' . $application->cv_path) }}" class="w-60 h-80 border rounded-lg"></iframe>
                                            <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                                                class="bg-gray-300 w-40 rounded-xl py-2 px-4 text-blue-600 text-sm inline-block mt-2 text-center">Download CV
                                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif

                                    @if($application->certificates && count($application->certificates) > 0)
                                        <div class="mt-4">
                                            <p class="text-sm font-semibold mb-2">Certificates Preview:</p>
                                            <div class="grid grid-cols-3 gap-4">
                                                @foreach($application->certificates as $cert)
                                                    @php
                                                        $ext = pathinfo($cert, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <div class="border rounded-lg p-2">
                                                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                                            <img src="{{ asset('storage/' . $cert) }}" class="w-full h-32 object-cover rounded-lg">
                                                        @else
                                                            <iframe src="{{ asset('storage/' . $cert) }}" class="w-full h-32 rounded-lg"></iframe>
                                                        @endif
                                                        <a href="{{ asset('storage/' . $cert) }}" target="_blank"
                                                            class="text-blue-600 text-sm block text-center mt-2">View Fullscreen
                                                            <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No applications submitted yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection