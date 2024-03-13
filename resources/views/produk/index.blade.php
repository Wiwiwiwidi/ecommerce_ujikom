@extends('main')
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            @foreach($produks as $product)
                <div class="col-lg-3 mb-4">
                    <div class="product-item">
                        <div class="product-title">
                            <a href="#">{{ $product->nama }}</a>
                            <div class="ratting">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="product-image">
                            <a href="{{ route('produk.show', $product->id) }}">
                                <img src="{{ asset('image/'. $product->img) }}" width="200" height="200" alt="{{ $product->nama }}">
                            </a>
                        </div>
                        <div class="product-price">
                            <h3><span>Rp.</span>{{ number_format($product->price) }}</h3>
                            <a class="btn btn-sm" href="{{ route('produk.show', $product->id) }}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
        <div class="row">
        <div class="col mt-3">
            {{ $produks->links() }}
        </div>
    </div>
    </div>
@endsection
