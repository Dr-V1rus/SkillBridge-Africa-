@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>

                    <div class="grid md:grid-cols-5 gap-4 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg text-center">
                            <p class="text-2xl font-bold">{{ $totalStudents }}</p>
                            <p class="text-sm">Students</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg text-center">
                            <p class="text-2xl font-bold">{{ $totalBusinesses }}</p>
                            <p class="text-sm">Businesses</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg text-center">
                            <p class="text-2xl font-bold">{{ $totalInternships }}</p>
                            <p class="text-sm">Internships</p>
                        </div>
                        <div class="bg-orange-100 p-4 rounded-lg text-center">
                            <p class="text-2xl font-bold">{{ $totalApplications }}</p>
                            <p class="text-sm">Applications</p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg text-center">
                            <p class="text-2xl font-bold">{{ $unreadMessages }}</p>
                            <p class="text-sm">Unread Messages</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.users') }}"
                            class="bg-gray-100 p-4 rounded-lg text-center hover:bg-gray-200">Manage Users</a>
                        <a href="{{ route('admin.internships') }}"
                            class="bg-gray-100 p-4 rounded-lg text-center hover:bg-gray-200">Manage Internships</a>
                        <a href="{{ route('admin.applications') }}"
                            class="bg-gray-100 p-4 rounded-lg text-center hover:bg-gray-200">Manage Applications</a>
                        <a href="{{ route('admin.contacts') }}"
                            class="bg-gray-100 p-4 rounded-lg text-center hover:bg-gray-200">View Contact Messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection