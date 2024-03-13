@extends('beranda.beranda')
@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h2>Review Produk{{ $produk->nama }}</h2>

    <form action="{{ route('ulasan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <div class="mb-4">
            <label for="ulasan" class="form-label">Komentar:</label>
            <textarea name="ulasan" id="ulasan" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="rating5" name="rating" value="5"><label for="rating5"></label>
                <input type="radio" id="rating4" name="rating" value="4"><label for="rating4"></label>
                <input type="radio" id="rating3" name="rating" value="3"><label for="rating3"></label>
                <input type="radio" id="rating2" name="rating" value="2"><label for="rating2"></label>
                <input type="radio" id="rating1" name="rating" value="1"><label for="rating1"></label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Review</button>
    </form>

    <div class="mt-4">
    <h3>Ulasan Produk</h3>
    @foreach($ulasan as $up)
    <div class="card mb-3">
        <div class="card-body">
            <h6 class="card-title">{{ $up->user->name }}  {{ date('d M Y', strtotime ($up->tanggal))}}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Rating:
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $up->rating)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </h6>
            <p class="card-text">{{ $up->ulasan }}</p>

        </div>
    </div>
    @endforeach
    {{ $ulasan->links() }}
</div>

<!-- CSS Styles -->
<style>
    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
        margin-right: 5px;
    }

    .star-rating label:before {
        content: '\2605'; /* Unicode character for star */
    }

    .star-rating input[type="radio"]:checked~label {
        color: #ffcc00; /* Change color of stars when checked */
    }
</style>

@endsection
