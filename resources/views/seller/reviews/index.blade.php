@extends('seller.layout')

@section('title', 'Ulasan Produk')
@section('page-title', 'Ulasan Produk')
@section('menu-reviews', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Pembeli</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->product->nama_produk ?? '-' }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>
                        @for($i=1; $i<=5; $i++)
                            <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                    </td>
                    <td>{{ $review->komentar ?? '-' }}</td>
                    <td>{{ $review->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada ulasan</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection
