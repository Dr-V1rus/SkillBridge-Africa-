@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">My Applications</h2>
                
                @forelse($applications as $application)
                    <div class="border p-4 rounded-lg mb-4">
                        <p class="font-semibold">{{ $application->internship->title }}</p>
                        <p class="text-sm text-gray-600">Company: {{ $application->internship->business->name }}</p>
                        <p class="text-sm text-gray-600">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                        <p class="text-gray-700 mt-2">{{ $application->message }}</p>
                        @if($application->portfolio_link)
                            <a href="{{ $application->portfolio_link }}" target="_blank" class="text-blue-600 text-sm mt-2 inline-block">View Portfolio →</a>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">No applications submitted yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection