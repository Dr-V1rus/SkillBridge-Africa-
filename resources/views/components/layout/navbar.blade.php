{{-- <div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div> --}}

<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/" class="flex items-center">
                <x-application-logo />
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
                <a href="{{ route('features') }}" class="text-gray-600 hover:text-gray-900">Features</a>
                <a href="{{ route('how-it-works') }}" class="text-gray-600 hover:text-gray-900">How It Works</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-900">About</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-900">Contact</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Sign Up</a>
            </div>

            <button @click="open = !open" class="md:hidden text-gray-600 hover:text-gray-900">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition class="md:hidden bg-white border-b border-gray-200">
        <div class="px-4 py-3 space-y-3">
            <a href="/" class="block text-gray-600 hover:text-gray-900">Home</a>
            <a href="{{ route('features') }}" class="block text-gray-600 hover:text-gray-900">Features</a>
            <a href="{{ route('how-it-works') }}" class="block text-gray-600 hover:text-gray-900">How It Works</a>
            <a href="{{ route('about') }}" class="block text-gray-600 hover:text-gray-900">About</a>
            <a href="{{ route('contact') }}" class="block text-gray-600 hover:text-gray-900">Contact</a>
            <div class="pt-3 border-t border-gray-200">
                <a href="{{ route('login') }}" class="block text-gray-600 hover:text-gray-900 mb-2">Login</a>
                <a href="{{ route('register') }}"
                    class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center hover:bg-blue-700 transition">Sign
                    Up</a>
            </div>
        </div>
    </div>
</nav>
