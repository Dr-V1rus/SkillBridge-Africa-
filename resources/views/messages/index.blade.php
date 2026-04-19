@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Chat</h2>
                    <a href="{{ url()->previous() }}" class="bg-gray-300 text-gray-600 px-4 py-2 rounded-lg">Back</a>
                </div>
                
                <div class="border-b pb-3 mb-4">
                    <p class="font-semibold">Internship: {{ $application->internship->title }}</p>
                    <p class="text-sm text-gray-600">
                        Between you and {{ Auth::id() === $application->student_id ? $application->internship->business->name : $application->student->name }}
                    </p>
                </div>
                
                <div id="chatMessages" class="h-96 overflow-y-auto mb-4 space-y-4 p-4 bg-gray-50 rounded-lg">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="{{ $message->sender_id === Auth::id() ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }} p-3 rounded-xl max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <p class="text-xs {{ $message->sender_id === Auth::id() ? 'text-blue-200' : 'text-gray-500' }} mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="flex gap-2">
                    <input type="text" id="messageInput" class="flex-1 border rounded-lg p-2" placeholder="Type your message...">
                    <button onclick="sendMessage()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const applicationId = {{ $application->id }};
    let lastMessageId = {{ $messages->last()->id ?? 0 }};
    
    function loadMessages() {
        fetch(`/applications/${applicationId}/messages/json`)
            .then(response => response.json())
            .then(messages => {
                const container = document.getElementById('chatMessages');
                let newMessages = false;
                
                messages.forEach(message => {
                    if (message.id > lastMessageId) {
                        const isSender = message.sender_id === {{ Auth::id() }};
                        const messageDiv = document.createElement('div');
                        messageDiv.className = `flex ${isSender ? 'justify-end' : 'justify-start'}`;
                        messageDiv.innerHTML = `
                            <div class="${isSender ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'} p-3 rounded-xl max-w-xs">
                                <p class="text-sm">${escapeHtml(message.message)}</p>
                                <p class="text-xs ${isSender ? 'text-blue-200' : 'text-gray-500'} mt-1">${message.created_at}</p>
                            </div>
                        `;
                        container.appendChild(messageDiv);
                        lastMessageId = message.id;
                        newMessages = true;
                    }
                });
                
                if (newMessages) {
                    container.scrollTop = container.scrollHeight;
                }
            });
    }
    
    function sendMessage() {
        const input = document.getElementById('messageInput');
        const message = input.value.trim();
        if (message === '') return;
        
        fetch(`/applications/${applicationId}/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                input.value = '';
                loadMessages();
            }
        });
    }
    
    function escapeHtml(str) {
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
    
    loadMessages();
    setInterval(loadMessages, 3000);
    
    // Scroll to bottom on load
    const container = document.getElementById('chatMessages');
    container.scrollTop = container.scrollHeight;
</script>
@endsection
