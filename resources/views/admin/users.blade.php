@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Users</h2>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 px-4 py-2 rounded-lg">Back</a>
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Students</h3>
                    <div class="space-y-2 mb-8">
                        @forelse($students as $student)
                            <div class="border p-3 rounded flex justify-between items-center">
                                <div>
                                    <p class="font-semibold">{{ $student->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $student->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('admin.user.delete', $student) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm"
                                        onclick="return confirm('Delete this user?')">Delete</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-500">No students.</p>
                        @endforelse
                    </div>

                    <h3 class="text-xl font-semibold mb-4">Businesses</h3>
                    <div class="space-y-2">
                        @forelse($businesses as $business)
                            <div class="border p-3 rounded flex justify-between items-center">
                                <div>
                                    <p class="font-semibold">{{ $business->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $business->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('admin.user.delete', $business) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm"
                                        onclick="return confirm('Delete this user?')">Delete</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-500">No businesses.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection