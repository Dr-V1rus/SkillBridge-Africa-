@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Apply for: {{ $internship->title }}</h2>
                    
                    <form method="POST" action="{{ route('applications.store') }}">
                        @csrf
                        <input type="hidden" name="internship_id" value="{{ $internship->id }}">
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Message to Business</label>
                            <textarea name="message" rows="5" class="w-full border rounded-lg p-2" required placeholder="Why are you interested? What skills do you bring?"></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Portfolio Link (GitHub, LinkedIn, personal site)</label>
                            <input type="url" name="portfolio_link" class="w-full border rounded-lg p-2" placeholder="https://...">
                        </div>
                        
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg">Submit Application</button>
                        <a href="{{ route('internships.show', $internship) }}" class="text-gray-600 ml-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection