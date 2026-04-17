<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-2xl mb-6 mx-auto">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Smart Matching</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Our platform matches students and businesses based on skills and needs — no long hiring process required.
            </p>
        </div>

        @php
            $recentInternships = App\Models\Internship::where('is_active', true)->latest()->take(3)->get();
            $recentStudents = App\Models\User::where('role', 'student')->latest()->take(3)->get();
        @endphp

        @if($recentInternships->count() > 0 || $recentStudents->count() > 0)
            <div class="grid md:grid-cols-2 gap-8">
                {{-- Matching Internships --}}
                @if($recentInternships->count() > 0)
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Recently Posted Internships
                    </h3>
                    <div class="space-y-4">
                        @foreach($recentInternships as $internship)
                            <div class="border-b border-gray-100 pb-3 last:border-0">
                                <p class="font-semibold text-gray-900">{{ $internship->title }}</p>
                                <p class="text-sm text-gray-600">{{ $internship->business->name ?? 'Company' }} • {{ ucfirst($internship->type) }} • {{ $internship->location }}</p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">{{ $internship->duration }}</span>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ ucfirst($internship->type) }}</span>
                                </div>
                                <a href="{{ route('internships.show', $internship) }}" class="text-blue-600 text-sm mt-2 inline-block font-semibold">Apply Now →</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Matching Students --}}
                @if($recentStudents->count() > 0)
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Available Students
                    </h3>
                    <div class="space-y-4">
                        @foreach($recentStudents as $student)
                            <div class="border-b border-gray-100 pb-3 last:border-0">
                                <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                                <p class="text-sm text-gray-600">{{ $student->applications->count() }} application(s) sent</p>
                                <p class="text-sm text-gray-500 mt-1">Looking for internship opportunities</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('internships.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 transition shadow-md">Browse All Opportunities</a>
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <p class="text-gray-500">No matches yet. Be the first to post an internship or register as a student!</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full">Join as Student</a>
                    <a href="{{ route('register.business') }}" class="border border-blue-600 text-blue-600 px-6 py-2 rounded-full">Post an Internship</a>
                </div>
            </div>
        @endif
    </div>
</section>