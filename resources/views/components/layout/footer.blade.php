{{-- <div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
</div> --}}

<footer class="bg-black text-gray-400 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <a href="/" class="text-white font-semibold text-lg">
                <img src="{{ asset('img/SkillBridge_logo2.jpeg') }}" alt="SkillBridge Africa" class=" h-28 w-auto">SkillBridge Africa</a>
                <p class="text-sm mt-2">Connecting students with small businesses across the Commonwealth.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Platform</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('features') }}" class="hover:text-white">Features</a></li>
                    <li><a href="{{ route('how-it-works') }}" class="hover:text-white">How It Works</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white">About</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('privacy') }}" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-white">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-center">
            <p>&copy; 2026 SkillBridge Africa. All rights reserved.</p>
        </div>
    </div>
</footer>
