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

                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
                    @endif

                    <div class="space-y-4">
                        @forelse($contacts as $contact)
                            <div class="border p-4 rounded-lg {{ $contact->is_read ? 'bg-white' : 'bg-yellow-50' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-semibold">{{ $contact->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $contact->email }}</p>
                                        <p class="text-sm text-gray-600">Subject: {{ $contact->subject }}</p>
                                        <p class="text-gray-700 mt-2">{{ $contact->message }}</p>

                                        @if($contact->reply)
                                            <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                                <p class="font-semibold text-sm">Admin Reply:</p>
                                                <p class="text-gray-700 text-sm">{{ $contact->reply }}</p>
                                                <p class="text-xs text-gray-500 mt-1">Replied on:
                                                    {{ $contact->updated_at->format('M d, Y H:i') }}</p>
                                            </div>
                                        @endif

                                        <p class="text-xs text-gray-500 mt-2">{{ $contact->created_at->format('M d, Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-2 ml-4">
                                        @if(!$contact->is_read)
                                            <form method="POST" action="{{ route('admin.contact.read', $contact) }}">
                                                @csrf
                                                <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Mark Read</button>
                                            </form>
                                        @endif

                                        <button onclick="toggleReplyForm({{ $contact->id }})"
                                            class="bg-green-600 text-white px-3 py-1 rounded text-sm">Reply</button>
                                    </div>
                                </div>

                                <div id="reply-form-{{ $contact->id }}" class="hidden mt-4 border-t pt-4">
                                    <form method="POST" action="{{ route('admin.contact.reply', $contact) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="block text-gray-700 mb-2">Reply to {{ $contact->name }}</label>
                                            <textarea name="reply" rows="4" class="w-full border rounded-lg p-2" required
                                                placeholder="Type your reply here..."></textarea>
                                        </div>
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Send
                                            Reply</button>
                                        <button type="button" onclick="toggleReplyForm({{ $contact->id }})"
                                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg ml-2">Cancel</button>
                                    </form>
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

    <script>
        function toggleReplyForm(id) {
            var form = document.getElementById('reply-form-' + id);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }
    </script>
@endsection