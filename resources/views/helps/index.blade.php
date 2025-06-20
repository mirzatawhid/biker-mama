<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">All Help Requests</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @foreach($helpRequests as $request)
            <div class="p-4 border bg-white rounded shadow">
                <h3 class="text-lg font-bold">{{ $request->urgency_level }} urgency @ {{ $request->location }}</h3>
                <p class="text-gray-600">{{ $request->situation }}</p>
                <p class="text-sm text-gray-500">Contact: {{ $request->contact_number }}</p>
                <p class="text-xs text-gray-400">Posted on {{ $request->created_at->format('d M Y h:i A') }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
