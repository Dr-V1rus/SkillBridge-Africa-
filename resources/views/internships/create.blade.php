@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-6">Post an Internship</h2>

                        <a href="{{ route('dashboard') }}"
                            class="bg-gray-300 text-gray-600 px-6 py-2 mb-4 rounded-lg">Back</a>
                    </div>

                    <form method="POST" action="{{ route('internships.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Title</label>
                            <input type="text" name="title" class="w-full border rounded-lg p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="5" class="w-full border rounded-lg p-2" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Skills Required (comma separated)</label>
                            <input type="text" name="skills_required" class="w-full border rounded-lg p-2"
                                placeholder="e.g., React, Python, UI Design">
                            <p class="text-xs text-gray-500 mt-1">List the skills needed for this internship</p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" class="w-full border rounded-lg p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Type</label>
                            <select name="type" class="w-full border rounded-lg p-2" required>
                                <option value="remote">Remote</option>
                                <option value="onsite">Onsite</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Duration</label>
                            <input type="text" name="duration" placeholder="e.g., 3 months"
                                class="w-full border rounded-lg p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Application Deadline</label>
                            <input type="text" name="deadline" placeholder="e.g., April 30, 2026"
                                class="w-full border rounded-lg p-2" required>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Post Internship</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection