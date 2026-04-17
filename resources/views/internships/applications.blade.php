@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Applications for: {{ $internship->title }}</h2>
                        <a href="{{ route('internships.index') }}"
                            class="bg-gray-300 rounded-xl py-2 px-4 text-gray-600">Back</a>
                    </div>

                    <!-- Status Counters -->
                    <div class="grid grid-cols-4 gap-4 mb-6">
                        <a href="?status=all" class="bg-gray-100 p-4 rounded-lg text-center hover:bg-gray-200">
                            <p class="text-2xl font-bold">{{ $internship->applications->count() }}</p>
                            <p class="text-sm text-gray-600">Total</p>
                        </a>
                        <a href="?status=pending" class="bg-yellow-100 p-4 rounded-lg text-center hover:bg-yellow-200">
                            <p class="text-2xl font-bold">
                                {{ $internship->applications->where('status', 'pending')->count() }}
                            </p>
                            <p class="text-sm text-yellow-800">Pending</p>
                        </a>
                        <a href="?status=accepted" class="bg-green-100 p-4 rounded-lg text-center hover:bg-green-200">
                            <p class="text-2xl font-bold">
                                {{ $internship->applications->where('status', 'accepted')->count() }}
                            </p>
                            <p class="text-sm text-green-800">Accepted</p>
                        </a>
                        <a href="?status=rejected" class="bg-red-100 p-4 rounded-lg text-center hover:bg-red-200">
                            <p class="text-2xl font-bold">
                                {{ $internship->applications->where('status', 'rejected')->count() }}
                            </p>
                            <p class="text-sm text-red-800">Rejected</p>
                        </a>
                    </div>

                    @php
                        $status = request('status', 'all');
                        $applications = $status === 'all'
                            ? $internship->applications
                            : $internship->applications->where('status', $status);
                    @endphp

                    @forelse($applications as $application)
                        <div class="border p-4 rounded-lg mb-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="font-semibold">{{ $application->student->name }}</p>
                                    <p class="text-sm text-gray-600">Applied: {{ $application->created_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-gray-700 mt-2">{{ $application->message }}</p>

                                    <div class="flex flex-col gap-6 flex-wrap">
                                        @if($application->portfolio_link)
                                            <a href="{{ $application->portfolio_link }}" target="_blank"
                                                class="bg-gray-300 w-40 rounded-xl py-2 px-4 text-blue-600 text-sm mt-2 inline-block text-center">View
                                                Portfolio
                                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($application->cv_path)
                                            <div class="mt-2">
                                                <p class="text-sm font-semibold mb-1">CV Preview:</p>
                                                <iframe src="{{ asset('storage/' . $application->cv_path) }}"
                                                    class="w-60 h-80 border rounded-lg"></iframe>
                                                <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                                                    class="bg-gray-300 w-40 rounded-xl py-2 px-4 text-blue-600 text-sm inline-block mt-2 text-center">Download
                                                    CV
                                                    <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

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
                                                            <img src="{{ asset('storage/' . $cert) }}"
                                                                class="w-full h-32 object-cover rounded-lg">
                                                        @else
                                                            <iframe src="{{ asset('storage/' . $cert) }}"
                                                                class="w-full h-32 rounded-lg"></iframe>
                                                        @endif
                                                        <a href="{{ asset('storage/' . $cert) }}" target="_blank"
                                                            class="text-blue-600 text-sm block text-center mt-2">View Fullscreen
                                                            <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex flex-col gap-4 ml-4">
                                    <a href="{{ route('student.show', $application->student) }}"
                                        class="bg-blue-600 text-white px-4 py-2 rounded text-sm w-24 text-center hover:bg-blue-700 transition">Profile</a>
                                    <form method="POST" action="{{ route('applications.update', $application) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button
                                            class="bg-green-600 text-white px-4 py-2 rounded text-sm w-24 hover:bg-green-700 transition">Accept</button>
                                    </form>
                                    <form method="POST" action="{{ route('applications.update', $application) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button
                                            class="bg-red-600 text-white px-4 py-2 rounded text-sm w-24 hover:bg-red-700 transition">Reject</button>
                                    </form>
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
@endsection