@extends('layouts.app')

@section('content')
    
        <h2 class="flex justify-center mt-8 font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ auth()->user()->name }} to your Dashboard
        </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('internships.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Post New
                            Internship</a>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <a href="{{ route('internships.index') }}"
                            class="bg-purple-50 p-6 rounded-lg hover:bg-purple-100 transition block">
                            <h3 class="text-lg font-semibold mb-2">My Internships</h3>
                            <p class="text-3xl font-bold text-purple-600">{{ auth()->user()->internships->count() }}</p>
                            <p class="text-sm text-gray-600 mt-2">Manage postings <svg class="w-4 h-4 inline-block ml-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg></p>
                        </a>

                        <div class="bg-orange-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Total Applications</h3>
                            <p class="text-3xl font-bold text-orange-600">
                                {{ auth()->user()->internships->sum(fn($i) => $i->applications->count()) }}
                            </p>
                            <p class="text-sm text-gray-600 mt-2">Across all internships</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="bg-teal-50 p-6 rounded-lg hover:bg-teal-100 transition block">
                            <h3 class="text-lg font-semibold mb-2">Company Profile</h3>
                            <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-600 mt-2">Update settings <svg class="w-4 h-4 inline-block ml-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg></p>
                        </a>
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Recent Internships</h3>
                    <div class="space-y-4">
                        @forelse(auth()->user()->internships->take(5) as $internship)
                            <div class="border p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $internship->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $internship->applications->count() }}
                                            applications</p>
                                        <p class="text-xs text-gray-500">Posted
                                            {{ $internship->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-4">
                                        <a href="{{ route('internships.show', $internship) }}"
                                            class="text-blue-600 text-sm">View <svg class="w-4 h-4 inline-block ml-1"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg></a>
                                        <a href="{{ route('internships.applications', $internship) }}"
                                            class="text-purple-600 text-sm">Applications <svg class="w-4 h-4 inline-block ml-1"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No internships posted yet.</p>
                        @endforelse
                    </div>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}"
                        class="mb-2 mt-8 bg-red-600 w-24 rounded-full ml-6 py-4 px-4">
                        @csrf

                        <a href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection