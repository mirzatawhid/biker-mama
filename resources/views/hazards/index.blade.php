<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">All Hazard Reports</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @foreach ($hazards as $hazard)
            <div class="p-4 border bg-white rounded shadow">
                <h3 class="font-semibold text-lg">{{ ucfirst($hazard->hazard_type) }} @ {{ $hazard->location }}</h3>
                <p class="text-sm text-gray-600">{{ $hazard->description }}</p>
                <p class="text-xs text-gray-400">Reported on {{ $hazard->created_at->format('d M Y h:i A') }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
