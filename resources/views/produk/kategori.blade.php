
<!-- Tampilan kumpulan kategori -->
@extends('beranda.beranda')
@section('content')

<div class="container-fluid">
    <div class="col-md-12">
    <h4>All Kategori</h4>
    <div class="row mt-4">
        @foreach($kategori as $kategori)
        <div class="col-lg-3 mb-3">
            <a href="{{ url('view-kategori/'. $kategori->slug) }}">
            <div class="product-item">
                <div class="product-title">
                <div class="product-image">
                <img src="{{ asset('uploads/gambar/'.  $kategori->img) }}" width="200" height="200" alt="">
                    </a>
                </div>
                    <h4>{{ $kategori->nama }}</a></h4>
                    <p>{{ $kategori->deskripsi }}</p>
                 </a>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div
@endsection

