@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold text-secondary mb-0">
            <i class='bx bx-map text-primary'></i> Peta Lokasi Seller
        </h4>

        <a href="{{ route('admin.sellers') }}" class="btn btn-outline-secondary btn-sm">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>
    </div>

    {{-- Filter --}}
    <div class="card border-0 shadow-sm rounded-3 mb-3">
        <div class="card-body">
            <form id="filterForm" method="GET" action="{{ route('admin.seller.map') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="status" class="form-label fw-semibold">Status Seller</label>
                    <select name="status" id="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="seller" class="form-label fw-semibold">Cari Nama Toko</label>
                    <input type="text" name="seller" id="seller" class="form-control form-control-sm" placeholder="Ketik nama toko..." autocomplete="off" value="{{ request('seller') }}">

                    {{-- Dropdown autocomplete --}}
                    <ul id="suggestions" class="list-group position-absolute w-100 mt-1 shadow-sm" style="z-index: 999; display: none;"></ul>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-sm me-2">
                        <i class='bx bx-search'></i> Filter
                    </button>
                    <a href="{{ route('admin.seller.map') }}" class="btn btn-outline-secondary btn-sm">
                        <i class='bx bx-reset'></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Map --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div id="map" style="height: 600px; width: 100%; border-radius: .5rem;"></div>
        </div>
    </div>
</div>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([-2.5489, 118.0149], 5); // Indonesia
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const sellers = @json($sellers);
    const markers = [];

    // Tambahkan marker semua seller
    sellers.forEach(seller => {
        if (seller.latitude && seller.longitude) {
            const marker = L.marker([seller.latitude, seller.longitude]).addTo(map);
            marker.bindPopup(`
                <div style="min-width:200px;">
                    <h6 class="fw-semibold mb-1">${seller.nama_toko ?? 'Tanpa Nama'}</h6>
                    <p class="mb-1"><small><b>Pemilik:</b> ${seller.user?.name ?? '-'}</small></p>
                    <p class="mb-1"><small><b>Alamat:</b> ${seller.alamat ?? '-'}</small></p>
                    <p class="mb-1"><small><b>Telepon:</b> ${seller.no_telp ?? '-'}</small></p>
                    <span class="badge bg-${seller.status === 'aktif' ? 'success' : (seller.status === 'pending' ? 'warning text-dark' : 'secondary')}">
                        ${seller.status}
                    </span>
                </div>
            `);
            markers.push({ id: seller.id, marker });
        }
    });

    // Autocomplete search
    const input = document.getElementById('seller');
    const suggestionsBox = document.getElementById('suggestions');

    input.addEventListener('input', async function () {
        const query = this.value.trim();
        if (query.length < 2) {
            suggestionsBox.style.display = 'none';
            return;
        }

        const response = await fetch(`{{ route('admin.seller.search') }}?q=${query}`);
        const results = await response.json();

        suggestionsBox.innerHTML = '';
        if (results.length > 0) {
            results.forEach(item => {
                const li = document.createElement('li');
                li.className = 'list-group-item list-group-item-action';
                li.textContent = item.nama_toko;
                li.style.cursor = 'pointer';
                li.addEventListener('click', () => {
                    input.value = item.nama_toko;
                    suggestionsBox.style.display = 'none';
                    if (item.latitude && item.longitude) {
                        map.setView([item.latitude, item.longitude], 14);
                        L.popup()
                            .setLatLng([item.latitude, item.longitude])
                            .setContent(`<b>${item.nama_toko}</b><br>(${item.latitude}, ${item.longitude})`)
                            .openOn(map);
                    }
                });
                suggestionsBox.appendChild(li);
            });
            suggestionsBox.style.display = 'block';
        } else {
            suggestionsBox.style.display = 'none';
        }
    });

    // Klik di luar untuk menutup suggestions
    document.addEventListener('click', function (event) {
        if (!input.contains(event.target) && !suggestionsBox.contains(event.target)) {
            suggestionsBox.style.display = 'none';
        }
    });
});
</script>
@endsection
