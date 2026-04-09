@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Business Dashboard</h2>
                        <a href="{{ route('internships.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Post New Internship</a>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Your Internships</h3>
                            <p class="text-3xl font-bold text-purple-600">
                                {{ auth()->user()->internships ? auth()->user()->internships->count() : 0 }}</p>
                            <a href="{{ route('internships.index') }}" class="text-purple-600 mt-2 inline-block">Manage
                                →</a>
                        </div>
                        <div class="bg-orange-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Total Applications</h3>
                            <p class="text-3xl font-bold text-orange-600">
                                {{ auth()->user()->internships ? auth()->user()->internships->sum(fn($i) => $i->applications->count()) : 0 }}
                            </p>
                        </div>
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Recent Internships</h3>
                    <div class="space-y-4">
                        @forelse(auth()->user()->internships ?? [] as $internship)
                            <div class="border p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $internship->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $internship->applications->count() }}
                                            application(s)</p>
                                        <p class="text-xs text-gray-500">{{ $internship->created_at->diffForHumans() }}</p>
                                    </div>
                                    <a href="{{ route('internships.show', $internship) }}"
                                        class="text-blue-600 text-sm">View →</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No internships posted yet. Click the button above to create one.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
