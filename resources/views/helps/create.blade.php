<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Request Emergency Help</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('helps.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block">Location</label>
                <input type="text" name="location" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Describe the Situation</label>
                <textarea name="situation" class="w-full border p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block">Your Contact Number</label>
                <input type="text" name="contact_number" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Urgency Level</label>
                <select name="urgency_level" class="w-full border p-2" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Send Help Request</button>
        </form>
    </div>
</x-app-layout>
