<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">Top Student Talent</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @php
                $students = App\Models\User::where('role', 'student')->latest()->take(3)->get();
            @endphp
            
            @if($students->count() > 0)
                @foreach($students as $student)
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-900">{{ $student->name }}</h3>
                                <p class="text-sm text-blue-600">Student</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm">Available for internships. Looking for opportunities to gain experience.</p>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Applications sent: {{ $student->applications->count() }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Demo fallback content --}}
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl">A</div>
                        <div class="ml-4">
                            <h3 class="font-bold text-gray-900">Amara Okonkwo</h3>
                            <p class="text-sm text-blue-600">Web Developer</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">React, Node.js, Tailwind enthusiast. Built 3 full-stack projects.</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">React</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Node.js</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Tailwind</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-xl">C</div>
                        <div class="ml-4">
                            <h3 class="font-bold text-gray-900">Chidi Eze</h3>
                            <p class="text-sm text-blue-600">Graphic Designer</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Adobe Creative Suite, Figma, Canva. Created brand identities for 5+ businesses.</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Figma</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Photoshop</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Illustrator</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold text-xl">F</div>
                        <div class="ml-4">
                            <h3 class="font-bold text-gray-900">Fatima Bello</h3>
                            <p class="text-sm text-blue-600">Digital Marketer</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">SEO, content creation, social media management. Grew following by 200%.</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">SEO</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Content Writing</span>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Analytics</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 transition shadow-md">Join as Student</a>
        </div>
    </div>
</section>