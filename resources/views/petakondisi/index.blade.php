<!DOCTYPE html>
<html>
<head>
    <title>Peta Kondisi Jalan - LaporPak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        #map { height: 100vh; width: 100%; }
        .legend {
            background: white;
            padding: 15px;
            line-height: 20px;
            font-size: 14px;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
            border-radius: 8px;
        }
        .legend i {
            width: 18px;
            height: 10px;
            float: left;
            margin-right: 8px;
            opacity: 0.8;
        }
        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #007BFF;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <!-- Tombol Back -->
    <a href="{{ url()->previous() }}" class="back-btn">← Kembali</a>

    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const data = @json($data);

        // Set awal ke Bandung
        const map = L.map('map').setView([-6.914744, 107.609810], 12);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap',
            maxZoom: 18,
        }).addTo(map);

        // Tambahkan marker ke peta
        data.forEach(item => {
            let [lat, lng] = item.lokasi.split(',').map(Number);

            let color = '';
            switch (item.status.toLowerCase()) {
                case 'selesai':
                    color = 'green'; // Baik
                    break;
                case 'ditindaklanjuti':
                    color = 'orange'; // Sedang
                    break;
                default:
                    color = 'red'; // Rusak ringan
            }

            let marker = L.circleMarker([lat, lng], {
                radius: 8,
                fillColor: color,
                color: '#000',
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            }).addTo(map);

            marker.bindPopup(`<strong>${item.kategori}</strong><br>Status: ${item.status}`);
        });

        // Legend
        const legend = L.control({ position: 'bottomright' });
        legend.onAdd = function (map) {
            const div = L.DomUtil.create('div', 'legend');
            div.innerHTML += "<strong>Nilai Kondisi Jalan Nasional<br>Tahun 2025</strong><br><br>";
            div.innerHTML += '<i style="background:red"></i>Sedang diajukan<br>';
            div.innerHTML += '<i style="background:orange"></i>Dalam proses perbaikan<br>';
            div.innerHTML += '<i style="background:green"></i>Sudah diperbaiki<br>';
            return div;
        };
        legend.addTo(map);
    </script>

</body>
</html>
