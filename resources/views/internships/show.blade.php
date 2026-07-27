@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">{{ $internship->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $internship->description }}</p>
                    @if($internship->skills_required)
                        <p class="text-sm text-gray-600">Skills Required: {{ $internship->skills_required }}</p>
                    @endif
                    @auth
                        @if(auth()->user()->role === 'student')
                            @php
                                $studentSkills = auth()->user()->skills ?? '';
                                $studentSkillArray = array_map('trim', explode(',', $studentSkills));
                                $internshipSkills = $internship->skills_required ?? '';
                                $internshipSkillArray = array_map('trim', explode(',', $internshipSkills));
                                $matchedSkills = array_intersect($studentSkillArray, $internshipSkillArray);
                                $matchCount = count($matchedSkills);
                                $totalSkills = max(count($studentSkillArray), 1);
                                $matchPercentage = ($matchCount / $totalSkills) * 100;
                            @endphp

                            @if($matchPercentage > 0)
                                <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg font-bold text-blue-600">{{ round($matchPercentage) }}% Match</span>
                                        <div class="flex-1 max-w-[300px] bg-gray-200 rounded-full h-3">
                                            <div class="bg-blue-600 h-3 rounded-full" style="width: {{ round($matchPercentage) }}%">
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($matchedSkills) > 0)
                                        <p class="text-sm text-gray-600 mt-2">
                                            <span class="font-semibold">Matching skills:</span>
                                            @foreach($matchedSkills as $skill)
                                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded ml-1">{{ $skill }}</span>
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                            @endif
                        @endif
                    @endauth
                    <p class="text-sm text-gray-600">Location: {{ $internship->location }}</p>
                    <p class="text-sm text-gray-600">Type: {{ $internship->type }}</p>
                    <p class="text-sm text-gray-600">Duration: {{ $internship->duration }}</p>
                    <p class="text-sm text-gray-600">Deadline: {{ $internship->deadline }}</p>

                    @auth
                        @if(auth()->user()->role === 'student')
                            <a href="{{ route('applications.create', $internship) }}"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg mt-6 inline-block">Apply Now</a>
                        @elseif(auth()->user()->role === 'business')
                            <a href="{{ route('internships.applications', $internship) }}"
                                class="bg-purple-600 text-white px-6 py-2 rounded-lg mt-6 inline-block">View Applications
                                ({{ $internship->applications->count() }})</a>
                        @endif
                    @else
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200 text-center">
                            <p class="text-gray-700 mb-3">Interested in this internship?</p>
                            <a href="{{ route('login') }}"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg inline-block hover:bg-green-700 transition">Login
                                to Apply</a>
                            <p class="text-sm text-gray-500 mt-2">Don't have an account? <a href="{{ route('register') }}"
                                    class="text-blue-600 hover:underline">Register as Student</a></p>
                        </div>
                    @endauth

                    <a href="{{ route('internships.index') }}"
                        class="bg-gray-300 text-gray-600 px-6 py-2 rounded-lg ml-4">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection