@extends('pembeli.index')
@section('title', 'Home')

@section('home')

<style>
.hero-section {
    position: relative;
    width: 100vw;
    height: 100vh;
    background-image: url("{{ asset('img/umkm.jpg') }}");
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    color: #1a1a1a;
    padding: 0 40px;
    font-family: Arial, sans-serif;
    
}

  .hero-overlay {
    position: absolute;
    inset: 0;
    /* background-color: rgba(255, 255, 255, 0.6); */
    z-index: 1;
  }

  .hero-content {
    position: relative;
    max-width: 600px;
    z-index: 2;
    font-family: Arial, sans-serif;
    /* Tambahkan ini untuk geser ke kiri */
    /* atau gunakan padding-left: 20px; */
  }

  .hero-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    color: white
  }

  .hero-content p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: white
  }

  .btn-primary-custom {
        background-color: white;
        color: black;
        border: none;
        padding: 14px 32px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        margin-right: 15px;
        transition: all 0.3s ease;
        font-size: 1rem;
        text-decoration: none;
        display: inline-block;
    }
    .btn-primary-custom:hover {
        background-color: black;
        color: white;
        /* border: 2px solid #111111; */
        transform: translateY(-2px);
        text-decoration: none;
    }

  .btn-container {
    display: flex;
  }

  @media (max-width: 768px) {
    .hero-section {
      flex-direction: column;
      padding: 40px 15px;
      min-height: auto;
    }

    .hero-content {
      max-width: 100%;
      text-align: center;
      /* Reset margin untuk mobile */
      margin-left: 0;
    }

    .btn-container {
      justify-content: center;
    }
  }
</style>

<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-content">
      <h1>Dukung Produk Lokal, Bangga Buatan Majene</h1>
      <p style="font-weight: 500">Temukan berbagai produk unggulan dari pelaku UMKM di Kabupaten Majene</p>
      <p style="font-weight: 500">Mari bersama kita majukan ekonomi daerah melalui karya dan inovasi lokal</p>
      <div class="btn-container">
        <a href="{{ url('/lihat-umkm') }}" class="btn-primary-custom">Lihat UMKM</a>
        <a href="{{ url('/daftarkan-umkm') }}" class="btn-primary-custom">Daftarkan UMKM Anda</a>
      </div>
    </div>
  </div>
</section>

@endsection