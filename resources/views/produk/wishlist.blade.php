@extends('beranda.beranda')
@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Display success message if any -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        

 <!-- Wishlist Start -->
 <div class="wishlist-page">
            <div class="container-fluid">
            <h1 class="cart-title" style="font-weight: bold;">Wishlist</h1>

                <div class="wishlist-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Tambah Cart</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($wishlist as $item)  
                                    <tr>
                                        <td>
                                            <div class="img">
                                                <a href="#"><img src="{{ asset('image/' . $item->produk->img) }}" alt="Product Image" width="50"></a>
                                                <p>{{ $item->produk->nama }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="img">
                                                <p>Rp.{{ number_format($item->produk->price) }}</p>
                                            </div>
                                        </td>
                                            <form method="post" action="{{ route('cart.add', ['produk' => $item->produk->id]) }}">
                                                @csrf <!-- Menambahkan token CSRF untuk melindungi formulir dari serangan CSRF -->
                                                <td>
                                                <div class="qty">
                                                <input type="number" name="qty" value="1" min="1">
                                                </div>
                                                </td>
                                             <td><button class="btn-cart">Add to Cart</button></td>
                                            </form>
                                            <!-- End of Form untuk menambahkan produk ke ker anjang -->
                                        <td>
                                            <form action="{{ route('wishlist.destroy', $item->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
