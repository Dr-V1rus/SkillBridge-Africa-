@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Applications for: {{ $internship->title }}</h2>
                    <a href="{{ route('internships.index') }}" class="text-gray-600">← Back</a>
                </div>

                @forelse($internship->applications as $application)
                    <div class="border p-4 rounded-lg mb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold">{{ $application->student->name }}</p>
                                <p class="text-sm text-gray-600">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                                <p class="text-gray-700 mt-2">{{ $application->message }}</p>
                                @if($application->portfolio_link)
                                    <a href="{{ $application->portfolio_link }}" target="_blank" class="text-blue-600 text-sm mt-2 inline-block">View Portfolio →</a>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('applications.update', $application) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button class="bg-green-600 text-white px-3 py-1 rounded text-sm">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('applications.update', $application) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Reject</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No applications yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection