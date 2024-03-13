@extends('beranda.beranda')
@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('image/' . $produks->img) }}" class="rounded mx-auto d-block" height="80%" width="80%" alt=""> 
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{ $produks->nama }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format( $produks->price ) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        @if($produks->prod_qty > 0)
                                                <label class="badge bg-success">In Stock</label>
                                            @else
                                                <label class="badge bg-danger">Out Of Stock</label>
                                            @endif
                                        <td>
                                            {{ number_format($produks->prod_qty) }}
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Pesan</td>
                                        <td>:</td>
                                        <td>
                                            <form method="post" action="{{ route('cart.add', ['produk' => $produks->id]) }}">
                                                @csrf
                                                <label for="qty">Qty:</label>
                                                <input type="number" name="qty" value="1" min="1">
                                                <button type="submit" class="btn btn-success btn-sm mt-2"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                            </form>
                                            <form method="post" action="{{ url('wishlist/add', $produks->id) }}">
                                                @csrf  
                                                <button class="btn btn-danger btn-sm mt-2"><i class="fas fa-heart"></i> Add to Wishlist</button>
                                            </form>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        
<div class="row product-detail-bottom">
    <div class="col-lg-12">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#reviews">Reviews</a>
                </li>
            </ul>
            
                    <div class="tab-content">
                        <div id="description" class="container tab-pane active">
                                <h4>Product description</h4>
                                <p>
                                {{  $produks->deskripsi }}
                                </p>
                            </div>

                        <div id="reviews" class="container tab-pane fade">
                        @foreach($ulasan as $up)
                        <div class="reviews-submitted">
                                <div class="reviewer">{{ $up->user->name }}  {{ date('d M Y', strtotime ($up->tanggal))}}</div>
                            <div class="ratting">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $up->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                        </div>
                        <div>
                            <label for="text">Komentar: {{ $up->ulasan}}</label>
                        </div>
                        @endforeach
                        
                      
                    {{ $ulasan->links() }}
                                </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
