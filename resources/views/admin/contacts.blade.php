@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Contact Messages</h2>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 px-4 py-2 rounded-lg">Back</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($contacts as $contact)
                            <div class="border p-4 rounded-lg {{ $contact->is_read ? 'bg-white' : 'bg-yellow-50' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $contact->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $contact->email }}</p>
                                        <p class="text-sm text-gray-600">Subject: {{ $contact->subject }}</p>
                                        <p class="text-gray-700 mt-2">{{ $contact->message }}</p>
                                        <p class="text-xs text-gray-500 mt-2">{{ $contact->created_at->format('M d, Y H:i') }}
                                        </p>
                                    </div>
                                    @if(!$contact->is_read)
                                        <form method="POST" action="{{ route('admin.contact.read', $contact) }}">
                                            @csrf
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Mark Read</button>
                                        </form>
                                    @else
                                        <span class="text-green-600 text-sm">Read</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No contact messages yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection