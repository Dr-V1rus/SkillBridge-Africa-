@extends('layouts.landing')

@section('content')
    <div class="pt-32 pb-20 px-4 max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-12 text-center">Frequently Asked Questions</h1>
        <div x-data="{ open: null }" class="space-y-4">
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <button @click="open = open === 1 ? null : 1"
                    class="w-full text-left font-semibold text-lg flex justify-between items-center">
                    Is SkillBridge Africa free for students?
                    <svg x-show="open !== 1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="open === 1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
                <div x-show="open === 1" x-collapse class="mt-2 text-gray-600">
                    Yes, completely free. Students never pay to find or apply for internships.
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <button @click="open = open === 2 ? null : 2"
                    class="w-full text-left font-semibold text-lg flex justify-between items-center">
                    What types of businesses can post internships?
                    <svg x-show="open !== 2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="open === 2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
                <div x-show="open === 2" x-collapse class="mt-2 text-gray-600">
                    Any registered small business in Nigeria and participating Commonwealth countries.
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <button @click="open = open === 3 ? null : 3"
                    class="w-full text-left font-semibold text-lg flex justify-between items-center">
                    How do I know internships are real?
                    <svg x-show="open !== 3" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="open === 3" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
                <div x-show="open === 3" x-collapse class="mt-2 text-gray-600">
                    We verify businesses before they can post. Students can report suspicious listings.
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <button @click="open = open === 4 ? null : 4"
                    class="w-full text-left font-semibold text-lg flex justify-between items-center">
                    Can I apply from any Commonwealth country?
                    <svg x-show="open !== 4" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="open === 4" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
                <div x-show="open === 4" x-collapse class="mt-2 text-gray-600">
                    Yes, the platform is designed for all 56 Commonwealth nations starting with Nigeria.
                </div>
            </div>
        </div>
    </div>
@endsection