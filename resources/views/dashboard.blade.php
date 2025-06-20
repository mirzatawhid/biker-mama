<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="p-6 space-y-6 max-w-md mx-auto">
        <!-- Submit buttons -->
        <a href="{{ route('hazards.create') }}" 
           class="block text-center bg-blue-800 text-white py-3 rounded hover:bg-blue-700 transition">
            Report a Hazard
        </a>

        <a href="{{ route('helps.create') }}" 
           class="block text-center bg-red-600 text-white py-3 rounded hover:bg-red-500 transition">
            Request Emergency Help
        </a>

        <hr class="my-6">

        <!-- View ALL submissions -->
        <a href="{{ route('hazards.index') }}" 
           class="block text-center bg-blue-600 text-white py-3 rounded hover:bg-blue-500 transition">
            View ALL Hazard Reports
        </a>

        <a href="{{ route('helps.index') }}" 
           class="block text-center bg-red-500 text-white py-3 rounded hover:bg-red-400 transition">
            View ALL Help Requests
        </a>

        <hr class="my-6">

        <!-- View MY submissions -->
        <a href="{{ route('hazards.my') }}" 
           class="block text-center bg-blue-400 text-white py-3 rounded hover:bg-blue-300 transition">
            View My Hazard Reports
        </a>

        <a href="{{ route('helps.my') }}" 
           class="block text-center bg-red-400 text-white py-3 rounded hover:bg-red-300 transition">
            View My Help Requests
        </a>
    </div>
</x-app-layout>
