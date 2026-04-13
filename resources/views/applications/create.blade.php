@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-6">Apply for: {{ $internship->title }}</h2>

                    <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-600 px-6 py-2 mb-4 rounded-lg">Back</a>
                    </div>

                    <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="internship_id" value="{{ $internship->id }}">

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Message to Business</label>
                            <textarea name="message" rows="5" class="w-full border rounded-lg p-2" required
                                placeholder="Why are you interested? What skills do you bring?"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Portfolio Link (GitHub, LinkedIn, personal site)</label>
                            <input type="url" name="portfolio_link" class="w-full border rounded-lg p-2"
                                placeholder="https://...">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Upload CV (PDF, DOC, DOCX)</label>
                            <input type="file" name="cv" accept=".pdf,.doc,.docx" class="w-full border rounded-lg p-2">
                            <p class="text-xs text-gray-500 mt-1">Max 5MB. PDF or Word documents only.</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Upload Certificates (Multiple files)</label>
                            <input type="file" name="certificates[]" multiple accept=".pdf,.jpg,.png"
                                class="w-full border rounded-lg p-2">
                            <p class="text-xs text-gray-500 mt-1">Max 5 files, 5MB each. PDF, JPG, PNG only.</p>
                        </div>

                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg">Submit
                            Application</button>
                        <a href="{{ route('internships.show', $internship) }}" class="text-gray-600 ml-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection