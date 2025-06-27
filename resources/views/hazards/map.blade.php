<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Hazard Map</h2>
    </x-slot>

    <div class="p-4 max-w-7xl mx-auto space-y-6">
        <!-- Filter -->
        <form method="GET" action="{{ route('hazards.map') }}" class="mb-4">
            <label class="block mb-1 font-medium">Filter by Hazard Type:</label>
            <select name="type" onchange="this.form.submit()" class="border p-2 rounded w-full sm:w-60">
                <option value="">-- All Hazards --</option>
                @foreach ($types as $t)
                    <option value="{{ $t }}" {{ $type === $t ? 'selected' : '' }}>
                        {{ ucfirst($t) }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Map -->
        <div id="map" class="rounded border" style="height: 500px;"></div>
    </div>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const map = L.map('map').setView([23.8103, 90.4125], 11); // Default to Dhaka
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const hazardData = @json($hazards);

        const colors = {
            pothole: 'blue',
            construction: 'orange',
            accident: 'red',
            other: 'gray'
        };

        hazardData.forEach(hazard => {
            if (!hazard.latitude || !hazard.longitude) return;

            const color = colors[hazard.hazard_type] || 'black';

            const marker = L.circleMarker([hazard.latitude, hazard.longitude], {
                radius: 8,
                color: color,
                fillColor: color,
                fillOpacity: 0.8
            }).addTo(map);

            marker.bindPopup(`
                <strong>Type:</strong> ${hazard.hazard_type}<br>
                <strong>Description:</strong> ${hazard.description}<br>
                <strong>Address:</strong> ${hazard.address ?? 'N/A'}<br>
                <small>Reported: ${new Date(hazard.created_at).toLocaleString()}</small>
            `);
        });
    </script>
</x-app-layout>
