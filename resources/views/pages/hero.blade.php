<section class="pt-32 pb-20 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Connect Students With Small Businesses That Need
            Talent</h1>
        <p class="text-xl text-gray-600 mb-8">SkillBridge Africa helps students find real internships while helping small
            businesses access fresh talent across Nigeria and the Commonwealth.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}"
                class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Join as
                Student</a>
            <a href="{{ route('register.business') }}"
                class="border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">Post
                an Internship</a>
        </div>
        <a href="{{ route('internships.index') }}"
            class="inline-block bg-blue-600 mt-6 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Explore
            Internships</a>
        <p class="text-sm text-gray-500 mt-6">Free for students. Businesses pay only when you find the right match.</p>
    </div>
</section>
