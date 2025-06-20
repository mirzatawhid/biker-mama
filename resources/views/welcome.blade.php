<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biker Buddy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <!-- Header -->
    <header class="bg-blue-800 text-white py-6 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold">🏍️ Biker Buddy</h1>
        
        @guest
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-blue-800 px-4 py-2 rounded hover:bg-gray-100 font-semibold">Login</a>
                <a href="{{ route('register') }}" class="bg-yellow-400 text-blue-800 px-4 py-2 rounded hover:bg-yellow-300 font-semibold">Register</a>
            </div>
        @endguest

        @auth
            <span class="text-sm text-white opacity-75">Welcome, {{ Auth::user()->name }}!</span>
        @endauth
    </div>
</header>


    <!-- Hero Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4">Welcome to Biker Buddy</h2>
            <p class="text-lg text-gray-700 mb-6 max-w-xl mx-auto">
                A community-powered web app built to improve biker safety and collaboration.
            </p>
            <p class="text-md text-gray-600 max-w-2xl mx-auto">
                Biker Buddy helps bikers share road conditions, report hazards like potholes and accidents, 
                request emergency help from nearby bikers, and share their favorite biking routes with the community.
            </p>
        </div>
    </section>

    <!-- Feature Highlights -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
            <div class="bg-white shadow p-6 rounded">
                <h3 class="text-xl font-semibold mb-2">🚧 Report Road Hazards</h3>
                <p class="text-gray-600">Bikers can report potholes, accidents, and other dangers to keep others safe.</p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h3 class="text-xl font-semibold mb-2">🆘 Request Help</h3>
                <p class="text-gray-600">In trouble? Request help from other bikers in your area with just a few clicks.</p>
            </div>

            <div class="bg-white shadow p-6 rounded">
                <h3 class="text-xl font-semibold mb-2">🗺️ Share Routes</h3>
                <p class="text-gray-600">Share scenic or safe biking routes to build a smarter, safer community.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center py-6 mt-12">
        <p class="text-sm">© {{ date('Y') }} Biker Buddy — Made by and for Bikers</p>
    </footer>
</body>
</html>
