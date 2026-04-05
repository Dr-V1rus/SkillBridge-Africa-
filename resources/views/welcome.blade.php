<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillBridge Africa</title>
    @vite('resources/css/app.css')
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card { @apply bg-white rounded-lg shadow-lg p-6 transition-transform hover:scale-105; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">SkillBridge Africa</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Join Now</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-4">Connect Students With Small Businesses That Need Talent</h2>
            <p class="text-xl mb-8">Building skills, driving economies across the Commonwealth</p>
            <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">Get Started</a>
        </div>
    </div>

    <!-- Features -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="card">
                <h3 class="text-xl font-bold mb-2">For Students</h3>
                <p class="text-gray-600">Find internships that match your skills. Build your portfolio while you learn.</p>
            </div>
            <div class="card">
                <h3 class="text-xl font-bold mb-2">For Businesses</h3>
                <p class="text-gray-600">Discover motivated students ready to contribute. Post opportunities in minutes.</p>
            </div>
            <div class="card">
                <h3 class="text-xl font-bold mb-2">Across 56 Nations</h3>
                <p class="text-gray-600">Part of the Commonwealth innovation ecosystem. Scale your impact globally.</p>
            </div>
        </div>
    </div>
</body>
</html>