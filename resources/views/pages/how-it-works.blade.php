{{-- <div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div> --}}

@extends('layouts.landing')

@section('content')
    
<section id="how-it-works" class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">How It Works</h2>
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div
                    class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                    1</div>
                <h3 class="font-semibold mb-2">Create Account</h3>
                <p class="text-gray-600 text-sm">Choose student or business role</p>
            </div>
            <div>
                <div
                    class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                    2</div>
                <h3 class="font-semibold mb-2">Build Profile</h3>
                <p class="text-gray-600 text-sm">Add skills, portfolio, or company info</p>
            </div>
            <div>
                <div
                    class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                    3</div>
                <h3 class="font-semibold mb-2">Find or Post</h3>
                <p class="text-gray-600 text-sm">Students browse. Businesses post internships</p>
            </div>
            <div>
                <div
                    class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                    4</div>
                <h3 class="font-semibold mb-2">Connect</h3>
                <p class="text-gray-600 text-sm">Apply or review applications</p>
            </div>
        </div>
    </div>
</section>
@endsection
