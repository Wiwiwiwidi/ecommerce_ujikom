
<!-- Tampilan kumpulan produk di kategori -->
@extends('beranda.beranda')
@section('content')

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <h2 class="mb-4">{{$kategori->nama}}</h2>
        </div>
        @foreach($produks as $p)
        <div class="col-lg-3 mb-4">
            <div class="product-item">
                <div class="product-title">
                    <a href="#">{{ $p->nama }}</a>
                    <div class="ratting">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                    </div>
                </div>
                <div class="product-image">
                    <a href="{{ route('produk.show', $p->id) }}">
                        <img src="{{ asset('image/'. $p->img) }}" width="200" height="200" alt="">
                    </a>
                </div>
                <div class="product-price">
                    <h3><span>Rp.</span>{{ number_format($p->price) }}</h3>
                    <a class="btn" href="{{ route('produk.show', $p->id) }}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div
@endsection
