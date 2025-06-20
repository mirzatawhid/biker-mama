<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Help Requests</h2>
    </x-slot>

    <div class="p-6 space-y-4 max-w-3xl mx-auto">
        @forelse ($helps as $help)
            <div class="p-4 border rounded bg-white shadow">
                <h3 class="font-bold text-lg">{{ ucfirst($help->urgency_level) }} urgency at {{ $help->location }}</h3>
                <p>{{ $help->situation }}</p>
                <p>Contact: {{ $help->contact_number }}</p>
                <p class="text-sm text-gray-500">Requested on {{ $help->created_at->format('d M Y, h:i A') }}</p>
            </div>
        @empty
            <p>You have not submitted any help requests yet.</p>
        @endforelse
    </div>
</x-app-layout>
