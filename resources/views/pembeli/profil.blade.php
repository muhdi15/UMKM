@extends('pembeli.index')
@section('title', 'Profil')

@section('profil')
<section class="profile spad">
    <div class="container">

        <div class="row">
            <!-- Sidebar Profil -->
            <div class="col-lg-3">
                <div class="profile-sidebar">
                    <div class="profile-card text-center">
                        <div class="profile-avatar">
                            <img src="{{ asset('img/discount.jpg') }}" alt="Profile" class="avatar-img">
                            <div class="avatar-upload">
                                <button class="btn-upload" onclick="document.getElementById('avatar-input').click()">
                                    <i class="fa fa-camera"></i>
                                </button>
                                <input type="file" id="avatar-input" accept="image/*" style="display: none;">
                            </div>
                        </div>
                        <div class="profile-info">
                            <h4>{{ Auth::user()->name ?? 'User Name' }}</h4>
                            <p class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                            <div class="member-badge">
                                <span class="badge-member">Member Silver</span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-menu">
                        <ul>
                            <li class="active">
                                <a href="#personal-info">
                                    <i class="fa fa-user me-2"></i>Informasi Pribadi
                                </a>
                            </li>
                            <li>
                                <a href="#address">
                                    <i class="fa fa-map-marker me-2"></i>Alamat Saya
                                </a>
                            </li>
                            <li>
                                <a href="#security">
                                    <i class="fa fa-lock me-2"></i>Keamanan
                                </a>
                            </li>
                            <li>
                                <a href="#preferences">
                                    <i class="fa fa-cog me-2"></i>Preferensi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Konten Profil -->
            <div class="col-lg-9">
                <!-- Informasi Pribadi -->
                <div class="profile-content" id="personal-info">
                    <div class="content-header">
                        <h4><i class="fa fa-user me-2"></i>Informasi Pribadi</h4>
                        <p>Kelola informasi dasar Anda</p>
                    </div>
                    
                    <div class="content-body">
                        <form class="profile-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fullname" value="{{ Auth::user()->name ?? 'John Doe' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email ?? 'johndoe@example.com' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="tel" class="form-control" id="phone" value="+62 812-3456-7890">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="birthdate" value="1990-01-01">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select class="form-control" id="gender">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="male" selected>Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="primary-btn">Simpan Perubahan</button>
                                <button type="button" class="site-btn btn-cancel">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Alamat Saya -->
                <div class="profile-content" id="address" style="display: none;">
                    <div class="content-header">
                        <h4><i class="fa fa-map-marker me-2"></i>Alamat Saya</h4>
                        <p>Kelola alamat pengiriman Anda</p>
                    </div>
                    
                    <div class="content-body">
                        <div class="address-list">
                            <!-- Alamat Utama -->
                            <div class="address-card primary">
                                <div class="address-header">
                                    <h5>Alamat Utama</h5>
                                    <span class="badge-primary">Utama</span>
                                </div>
                                <div class="address-content">
                                    <p><strong>John Doe</strong> | +62 812-3456-7890</p>
                                    <p>Jl. Contoh Alamat No. 123, Kelurahan Contoh</p>
                                    <p>Kecamatan Contoh, Kota Contoh, Provinsi Contoh, 12345</p>
                                </div>
                                <div class="address-actions">
                                    <button class="btn-edit">Edit</button>
                                    <button class="btn-delete">Hapus</button>
                                </div>
                            </div>

                            <!-- Alamat Lainnya -->
                            <div class="address-card">
                                <div class="address-header">
                                    <h5>Alamat Kantor</h5>
                                </div>
                                <div class="address-content">
                                    <p><strong>John Doe</strong> | +62 812-3456-7890</p>
                                    <p>Jl. Kantor No. 456, Gedung Contoh Lt. 5</p>
                                    <p>Kecamatan Business, Kota Contoh, Provinsi Contoh, 12345</p>
                                </div>
                                <div class="address-actions">
                                    <button class="btn-set-primary">Jadikan Utama</button>
                                    <button class="btn-edit">Edit</button>
                                    <button class="btn-delete">Hapus</button>
                                </div>
                            </div>
                        </div>

                        <button class="primary-btn btn-add-address">
                            <i class="fa fa-plus me-2"></i>Tambah Alamat Baru
                        </button>
                    </div>
                </div>

                <!-- Keamanan -->
                <div class="profile-content" id="security" style="display: none;">
                    <div class="content-header">
                        <h4><i class="fa fa-lock me-2"></i>Keamanan</h4>
                        <p>Kelola keamanan akun Anda</p>
                    </div>
                    
                    <div class="content-body">
                        <form class="security-form">
                            <div class="security-item">
                                <div class="security-info">
                                    <h5>Ubah Password</h5>
                                    <p>Pastikan password Anda kuat dan unik</p>
                                </div>
                                <button type="button" class="primary-btn" onclick="togglePasswordForm()">Ubah Password</button>
                            </div>

                            <div class="password-form" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current-password">Password Saat Ini</label>
                                            <input type="password" class="form-control" id="current-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new-password">Password Baru</label>
                                            <input type="password" class="form-control" id="new-password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm-password">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" id="confirm-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="primary-btn">Simpan Password</button>
                                    <button type="button" class="site-btn btn-cancel" onclick="togglePasswordForm()">Batal</button>
                                </div>
                            </div>
                        </form>

                        <div class="security-item">
                            <div class="security-info">
                                <h5>Sesi Aktif</h5>
                                <p>Kelola perangkat yang terhubung dengan akun Anda</p>
                            </div>
                            <button type="button" class="primary-btn">Lihat Sesi</button>
                        </div>
                    </div>
                </div>

                <!-- Preferensi -->
                <div class="profile-content" id="preferences" style="display: none;">
                    <div class="content-header">
                        <h4><i class="fa fa-cog me-2"></i>Preferensi</h4>
                        <p>Atur preferensi notifikasi dan bahasa</p>
                    </div>
                    
                    <div class="content-body">
                        <form class="preferences-form">
                            <div class="preference-section">
                                <h5>Notifikasi</h5>
                                <div class="preference-item">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="email-notif" checked>
                                        <label class="form-check-label" for="email-notif">
                                            Notifikasi Email
                                        </label>
                                    </div>
                                    <p class="preference-desc">Terima pemberitahuan via email tentang pesanan dan promo</p>
                                </div>
                                
                                <div class="preference-item">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="sms-notif" checked>
                                        <label class="form-check-label" for="sms-notif">
                                            Notifikasi SMS
                                        </label>
                                    </div>
                                    <p class="preference-desc">Terima pemberitahuan via SMS tentang status pengiriman</p>
                                </div>
                                
                                <div class="preference-item">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="promo-notif">
                                        <label class="form-check-label" for="promo-notif">
                                            Promo dan Penawaran Khusus
                                        </label>
                                    </div>
                                    <p class="preference-desc">Terima informasi tentang promo dan penawaran menarik</p>
                                </div>
                            </div>

                            <div class="preference-section">
                                <h5>Bahasa</h5>
                                <div class="form-group">
                                    <select class="form-control" id="language">
                                        <option value="id" selected>Bahasa Indonesia</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="primary-btn">Simpan Preferensi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.profile spad {
    padding: 50px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
}

.section-title h2 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 10px;
}

.section-title p {
    color: #666;
    font-size: 16px;
}

/* Sidebar Profil */
.profile-sidebar {
    position: sticky;
    top: 20px;
}

.profile-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.profile-avatar {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
}

.avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid none;
}

.avatar-upload {
    position: absolute;
    bottom: 0;
    right: 0;
}

.btn-upload {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ca1515;
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-upload:hover {
    background: #ca1515;
    transform: scale(1.1);
}

.profile-info h4 {
    margin-bottom: 5px;
    font-weight: 700;
}

.badge-member {
    background: linear-gradient(45deg, #C0C0C0, #E8E8E8);
    color: #333;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* Menu Profil */
.profile-menu {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.profile-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.profile-menu li {
    border-bottom: 1px solid #f1f1f1;
}

.profile-menu li:last-child {
    border-bottom: none;
}

.profile-menu li.active a {
    background: #ca1515;
    color: white;
}

.profile-menu a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
}

.profile-menu a:hover {
    background: #ca1515;
    color: #fff;
}

/* Konten Profil */
.profile-content {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.content-header {
    padding: 25px 30px;
    border-bottom: 1px solid #e9ecef;
}

.content-header h4 {
    margin-bottom: 5px;
    font-weight: 700;
    color: #333;
}

.content-header p {
    color: #666;
    margin: 0;
}

.content-body {
    padding: 30px;
}

/* Form Styles */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #ca1515;
    box-shadow: 0 0 0 0.2rem rgba(127, 173, 57, 0.25);
}

.form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

/* Alamat */
.address-list {
    margin-bottom: 20px;
}

.address-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.address-card.primary {
    border-color: #7fad39;
    background: #f8fff0;
}

.address-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 10px;
}

.address-header h5 {
    margin: 0;
    font-weight: 600;
}

.badge-primary {
    background: #7fad39;
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.address-content p {
    margin-bottom: 5px;
    color: #666;
}

.address-actions {
    margin-top: 15px;
}

.btn-edit, .btn-delete, .btn-set-primary {
    padding: 6px 15px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 5px;
    font-size: 12px;
    margin-right: 8px;
    transition: all 0.3s ease;
}

.btn-edit {
    border-color: #7fad39;
    color: #7fad39;
}

.btn-edit:hover {
    background: #7fad39;
    color: white;
}

.btn-delete {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-delete:hover {
    background: #dc3545;
    color: white;
}

.btn-set-primary {
    border-color: #17a2b8;
    color: #17a2b8;
}

.btn-set-primary:hover {
    background: #17a2b8;
    color: white;
}

.btn-add-address {
    width: 100%;
    padding: 12px;
}

/* Keamanan */
.security-item {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.security-item:last-child {
    border-bottom: none;
}

.security-info {
    flex: 1;
}

.security-info h5 {
    margin-bottom: 5px;
    font-weight: 600;
}

.security-info p {
    color: #666;
    margin: 0;
}

.password-form {
    margin-top: 20px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

/* Preferensi */
.preference-section {
    margin-bottom: 30px;
}

.preference-section h5 {
    margin-bottom: 20px;
    font-weight: 600;
    color: #333;
}

.preference-item {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.form-check-input:checked {
    background-color: #7fad39;
    border-color: #7fad39;
}

.preference-desc {
    font-size: 14px;
    color: #666;
    margin: 5px 0 0 0;
}

/* Buttons */
.primary-btn {
    background: #ca1515;
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.primary-btn:hover {
    background: #ca1515;
    color: white;
    transform: translateY(-2px);
}

/* .site-btn {
    background: #6c757d;
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}
 */
.site-btn:hover {
    background: #5a6268;
    color: white;
    
}

.btn-cancel {
    background: #6c757d;
}

.btn-cancel:hover {
    background: #5a6268;
}
</style>

<script>
// JavaScript untuk navigasi menu profil
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.profile-menu a');
    const contentSections = document.querySelectorAll('.profile-content');
    
    // Show first section by default
    contentSections[0].style.display = 'block';
    
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all items
            menuItems.forEach(i => i.parentElement.classList.remove('active'));
            
            // Add active class to clicked item
            this.parentElement.classList.add('active');
            
            // Hide all content sections
            contentSections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Show target section
            const targetId = this.getAttribute('href').substring(1);
            document.getElementById(targetId).style.display = 'block';
        });
    });
});

// Toggle password form
function togglePasswordForm() {
    const form = document.querySelector('.password-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

// Avatar upload preview
document.getElementById('avatar-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.avatar-img').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection