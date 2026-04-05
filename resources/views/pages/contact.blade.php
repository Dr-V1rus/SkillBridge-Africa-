@extends('layouts.landing')

@section('content')
    <div class="pt-32 pb-20 px-4 max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Contact Us</h1>
        <p class="text-gray-600 mb-8">Email: hello@skillbridge.africa</p>
        <form class="space-y-4">
            <input type="text" placeholder="Name" class="w-full p-3 border rounded-lg">
            <input type="email" placeholder="Email" class="w-full p-3 border rounded-lg">
            <textarea placeholder="Message" rows="5" class="w-full p-3 border rounded-lg"></textarea>
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg">Send Message</button>
        </form>
    </div>
    
@endsection
