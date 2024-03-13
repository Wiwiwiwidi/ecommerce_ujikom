@extends('beranda.beranda')
@section('content')
<!-- resources/views/cart.blade.php -->
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
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        

<div class="cart-page">
    <div class="container-fluid">
    <h1 class="cart-title" style="font-weight: bold;">Cart</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    @if($keranjang->isEmpty())
                        <p>Your cart is empty.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Description</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @php $total = 0; @endphp
                                    @foreach ($keranjang as $item)  
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
                                        <td>
                                            <div class="img">
                                                <div class="cart-item">
                                                    <form action="{{ route('cart.update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        @if($item->produk->prod_qty >= $item->qty)

                                                        <div class="quantity">
                                                            <button class="btn" type="submit" name="qty" value="{{ max(1, $item->qty - 1) }}" onclick="this.form.submit()">-</button>
                                                            <span>{{ $item->qty }}</span>
                                                            <button class="btn" type="submit" name="qty"  value="{{ $item->qty + 1 }}" onclick="this.form.submit()">+</button>
                                                        </div>
                                                        @else
                                                        <label class="badge bg-danger">Out Of Stock</label>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->produk->deskripsi }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                    $total += $item->qty * $item->produk->price;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>
                                    @if(!$keranjang->isEmpty())
                                        <h2>Total Price<span><p> Rp.{{ number_format($total) }}</p></span></h2>
                                        <div class="cart-btn">
                                            <button><a href="{{ url('/checkout') }}">Proceed To Checkout</a></button>
                                        </div>
                                    @endif
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
