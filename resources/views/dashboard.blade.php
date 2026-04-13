@extends('layouts.app')

@section('content')
    <h2 class="flex justify-center mt-8 font-semibold text-xl text-gray-800 leading-tight">
        Welcome {{ auth()->user()->name }} to your Dashboard
    </h2>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <a href="{{ route('applications.index') }}"
                            class="bg-blue-50 p-6 rounded-lg hover:bg-blue-100 transition block">
                            <h3 class="text-lg font-semibold mb-2">My Applications</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $applications->count() }}</p>
                            <p class="text-sm text-gray-600 mt-2">View all applications <svg
                                    class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg></p>
                        </a>

                        <a href="{{ route('internships.index') }}"
                            class="bg-green-50 p-6 rounded-lg hover:bg-green-100 transition block">
                            <h3 class="text-lg font-semibold mb-2">Browse Internships</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $internshipsCount }}</p>
                            <p class="text-sm text-gray-600 mt-2">Find opportunities <svg class="w-4 h-4 inline-block ml-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg></p>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="bg-purple-50 p-6 rounded-lg hover:bg-purple-100 transition block">
                            <h3 class="text-lg font-semibold mb-2">My Profile</h3>
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-sm text-gray-600 mt-2">Update your information <svg
                                    class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg></p>
                        </a>
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Recent Applications</h3>
                    <div class="space-y-4">
                        @forelse($applications->take(5) as $application)
                            <div class="border p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $application->internship->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $application->internship->business->name }}</p>
                                        <span
                                            class="inline-block px-2 py-1 text-xs rounded mt-2 
                                                                                    {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                                                                    {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                                                                    {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('internships.show', $application->internship) }}"
                                        class="text-blue-600 text-sm mt-8">View Internship <svg
                                            class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg></a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No applications yet. Start browsing internships!</p>
                        @endforelse
                    </div>
                </div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" class="mb-6 bg-red-600 w-24 rounded-full ml-6 py-4 px-4">
                    @csrf

                    <a href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection