@extends('pembeli.index')
@section('about')

<style>
    .hero-section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        color: #1a1a1a;
        padding: 80px 0;
        font-family: 'Montserrat', sans-serif;
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
        padding: 0 20px;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 25px;
        color: #111111;
    }

    .hero-content p {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #555555;
        line-height: 1.5;
    }

    .btn-primary-custom {
        background-color: #111111;
        color: white;
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
        background-color: #e53637;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-secondary-custom {
        background-color: transparent;
        color: #111111;
        border: 2px solid #111111;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary-custom:hover {
        background-color: #111111;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0;
            min-height: 50vh;
        }

        .hero-content h1 {
            font-size: 2.2rem;
        }

        .hero-content p {
            font-size: 1.1rem;
        }

        .btn-container {
            flex-direction: column;
            align-items: center;
        }

        .btn-primary-custom,
        .btn-secondary-custom {
            margin-right: 0;
            margin-bottom: 10px;
            width: 200px;
        }
    }

    @media (max-width: 576px) {
        .hero-content h1 {
            font-size: 1.8rem;
        }

        .hero-content p {
            font-size: 1rem;
        }

        .btn-primary-custom,
        .btn-secondary-custom {
            padding: 12px 24px;
            font-size: 0.9rem;
        }
    }
</style>

<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            {{-- <h1>Dukung Produk Lokal, Bangga Buatan Majene</h1> --}}
            <p>UMKM Majene adalah platform digital yang bertujuan untuk mempromosikan dan memperkenalkan</p>
            <p>berbagai usaha mikro,kecil, dan menengah yang ada di kabupaten Majene.</p>
            <br>
            <p>Melalui Situs ini, masyarakat dapat dengan mudah menemukan produk layanan, jajanan, dan inovasi lokal</p>
            <p>Sementara itu, pelaku UMKM dapat memperluas jangkauan pasar mereka secara online.</p>
            <br>
            <p>Kami percaya, <h5>Majene Maju Bersama UMKM Yang Kuat.</h5></p>
            <div class="btn-container">
                <a href="{{ route('user.umkm') }}" class="btn-primary-custom">Jelajahi UMKM</a>
                {{-- <a href="#" class="btn-secondary-custom">Pelajari Lebih Lanjut</a> --}}
            </div>
        </div>
    </div>
</section>

@endsection