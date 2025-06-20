<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Report a Hazard</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('hazards.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block">Location</label>
                <input type="text" name="location" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Description</label>
                <textarea name="description" class="w-full border p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block">Hazard Type</label>
                <select name="hazard_type" class="w-full border p-2" required>
                    <option value="pothole">Pothole</option>
                    <option value="construction">Construction</option>
                    <option value="accident">Accident</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
</x-app-layout>
