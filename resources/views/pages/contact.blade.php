@extends('layouts.landing')

@section('content')
    <div class="pt-32 pb-20 px-4 max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Contact Us</h1>
        <p class="text-gray-600 mb-8">Have questions? We'd love to hear from you. Send us a message and we'll respond within
            24 hours.</p>

        @if(session('contact_success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">Message sent successfully. We'll get back to you soon.
            </div>
        @endif

        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" required class="w-full p-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full p-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Subject</label>
                <input type="text" name="subject" required class="w-full p-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Message</label>
                <textarea name="message" rows="5" required class="w-full p-3 border rounded-lg"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Send
                Message</button>
        </form>
    </div>
@endsection