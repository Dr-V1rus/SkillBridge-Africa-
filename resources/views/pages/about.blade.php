@extends('layouts.landing')

@section('content')
    <div class="flex justify-center ml-10">
        <img src="{{ asset('img/SkillBridge_logo.jpeg') }}" alt="SkillBridge Africa" class=" h-auto w-auto">
    </div>
    <div class="pt-32 pb-20 px-4 max-w-4xl mx-auto">

        <h1 class="text-4xl font-bold text-gray-900 mb-6">About SkillBridge Africa</h1>

        <div class="prose prose-lg text-gray-600">
            <p class="mb-4">SkillBridge Africa is a platform dedicated to connecting talented students with small businesses
                across the Commonwealth nations.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Our Mission</h2>
            <p class="mb-4">To bridge the gap between education and employment by creating meaningful internship
                opportunities that benefit both students and small businesses.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Our Vision</h2>
            <p class="mb-4">A future where every African student gains practical work experience before graduation, and
                every small business has access to fresh, motivated talent.</p>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">What We Believe</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li>Every student deserves real-world experience before entering the workforce.</li>
                <li>Small businesses are the backbone of African economies and need affordable talent.</li>
                <li>Technology can bridge the gap between education and employment.</li>
                <li>The Commonwealth's 56 nations have immense potential when connected.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Our Story</h2>
            <p>SkillBridge Africa was born from the National Board for Technology Incubation's NextGen Innovation Challenge,
                recognizing the need for a dedicated platform connecting students with small businesses across Nigeria and
                the broader Commonwealth.</p>
        </div>
    </div>
@endsection