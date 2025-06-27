<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Report a Hazard</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('hazards.store') }}">
            @csrf

            <!-- Hazard Type -->
            <div class="mb-4">
                <label class="block font-medium">Hazard Type</label>
                <select name="hazard_type" class="w-full border p-2 rounded" required>
                    <option value="pothole">Pothole</option>
                    <option value="construction">Construction</option>
                    <option value="accident">Accident</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border p-2 rounded" required></textarea>
            </div>

            <!-- Map Section -->
            <div class="mb-4">
                <label class="block font-medium mb-2">Select Location (Map or Search)</label>
                <div id="map" class="rounded border" style="height: 350px;"></div>
                <button type="button" id="gpsBtn"
                        class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">
                    📍 Use My Current Location
                </button>
            </div>

            <!-- Address Field -->
            <div class="mb-4">
                <label class="block font-medium">Address</label>
                <input type="text" name="address" id="address" class="w-full border p-2 rounded" required readonly>
            </div>

            <!-- Hidden Coordinates -->
            <input type="hidden" name="latitude" id="latitude" required>
            <input type="hidden" name="longitude" id="longitude" required>

            <!-- Submit -->
            <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded">Submit Hazard</button>
        </form>
    </div>


    <!-- Map Script -->
    <script>
        let marker;
        const map = L.map('map').setView([23.8103, 90.4125], 13); // Default: Dhaka

        // Add tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Geocoder search bar
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        })
            .on('markgeocode', function(e) {
                const latlng = e.geocode.center;
                map.setView(latlng, 15);
                setMarkerAndAddress(latlng.lat, latlng.lng);
            })
            .addTo(map);

        // Function to set marker, lat/lng, and reverse geocode
        function setMarkerAndAddress(lat, lng) {
            // Set marker
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            // Set coords
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Reverse geocode
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('address').value = data.display_name || 'Unknown address';
                })
                .catch(() => {
                    document.getElementById('address').value = 'Unable to fetch address';
                });
        }

        // Click map to set marker
        map.on('click', function(e) {
            const { lat, lng } = e.latlng;
            setMarkerAndAddress(lat, lng);
        });

        // GPS Button
        document.getElementById('gpsBtn').addEventListener('click', () => {
            if (!navigator.geolocation) {
                alert('Geolocation is not supported by your browser');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    map.setView([lat, lng], 15);
                    setMarkerAndAddress(lat, lng);
                },
                () => {
                    alert('Unable to retrieve your location');
                }
            );
        });
    </script>

    <script>
    let marker;
    const map = L.map('map').setView([23.8103, 90.4125], 13); // Dhaka default

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    function setMarkerAndAddress(lat, lng, display_name = null) {
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (display_name) {
            document.getElementById('address').value = display_name;
        } else {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('address').value = data.display_name || 'Unknown address';
                });
        }
    }

    // Map click
    map.on('click', function (e) {
        const { lat, lng } = e.latlng;
        setMarkerAndAddress(lat, lng);
    });

    // GPS Button
    document.getElementById('gpsBtn').addEventListener('click', () => {
        if (!navigator.geolocation) return alert('Geolocation not supported.');
        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                map.setView([lat, lng], 15);
                setMarkerAndAddress(lat, lng);
            },
            () => alert('Unable to retrieve location.')
        );
    });

    // Autocomplete search logic
    const autocomplete = document.getElementById('autocomplete');
    const suggestionsBox = document.getElementById('suggestions');

    let debounceTimer;
    autocomplete.addEventListener('input', () => {
        const query = autocomplete.value.trim();
        clearTimeout(debounceTimer);

        if (query.length < 3) {
            suggestionsBox.classList.add('hidden');
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5`)
                .then(res => res.json())
                .then(results => {
                    suggestionsBox.innerHTML = '';
                    results.forEach(result => {
                        const option = document.createElement('div');
                        option.textContent = result.display_name;
                        option.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
                        option.addEventListener('click', () => {
                            autocomplete.value = result.display_name;
                            suggestionsBox.classList.add('hidden');
                            const lat = parseFloat(result.lat);
                            const lon = parseFloat(result.lon);
                            map.setView([lat, lon], 15);
                            setMarkerAndAddress(lat, lon, result.display_name);
                        });
                        suggestionsBox.appendChild(option);
                    });
                    suggestionsBox.classList.remove('hidden');
                });
        }, 300); // Debounce to prevent too many requests
    });

    // Hide suggestions if clicked outside
    document.addEventListener('click', function (e) {
        if (!autocomplete.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.classList.add('hidden');
        }
    });
</script>

</x-app-layout>
