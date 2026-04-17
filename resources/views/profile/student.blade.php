@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Student Profile</h2>
                    <a href="{{ url()->previous() }}" class="bg-gray-300 text-gray-600 px-4 py-2 rounded-lg">Back</a>
                </div>

                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Basic Information</h3>
                        <p class="mt-2"><span class="font-medium">Name:</span> {{ $user->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $user->email }}</p>
                        <p><span class="font-medium">Role:</span> Student</p>
                    </div>

                    @if($user->skill_category)
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Skills & Expertise</h3>
                        <p class="mt-2"><span class="font-medium">Skill Category:</span> {{ ucfirst(str_replace('_', ' ', $user->skill_category)) }}</p>
                        <p><span class="font-medium">Skills:</span> {{ $user->skills }}</p>
                        <p><span class="font-medium">Education Level:</span> {{ ucfirst($user->education_level) }}</p>
                        @if($user->portfolio_url)
                            <p><span class="font-medium">Portfolio:</span> <a href="{{ $user->portfolio_url }}" target="_blank" class="text-blue-600 hover:underline">{{ $user->portfolio_url }}</a></p>
                        @endif
                    </div>
                    @endif

                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Activity</h3>
                        <p class="mt-2"><span class="font-medium">Applications Sent:</span> {{ $user->applications->count() }}</p>
                        <p><span class="font-medium">Member Since:</span> {{ $user->created_at->format('M d, Y') }}</p>
                    </div>

                    @if($user->applications->count() > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Applied Internships</h3>
                        <div class="space-y-3">
                            @foreach($user->applications as $application)
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="font-semibold">{{ $application->internship->title }}</p>
                                    <p class="text-sm text-gray-600">Status: 
                                        <span class="px-2 py-1 text-xs rounded 
                                            {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </p>
                                    <a href="{{ route('internships.show', $application->internship) }}" class="text-blue-600 text-sm">View Internship →</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection