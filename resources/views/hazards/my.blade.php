<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Hazard Reports</h2>
    </x-slot>

    <div class="p-6 space-y-4 max-w-3xl mx-auto">
        @forelse ($hazards as $hazard)
            <div class="p-4 border rounded bg-white shadow">
                <h3 class="font-bold text-lg">{{ ucfirst($hazard->hazard_type) }} at {{ $hazard->location }}</h3>
                <p>{{ $hazard->description }}</p>
                <p class="text-sm text-gray-500">Reported on {{ $hazard->created_at->format('d M Y, h:i A') }}</p>
            </div>
        @empty
            <p>You have not submitted any hazard reports yet.</p>
        @endforelse
    </div>
</x-app-layout>
