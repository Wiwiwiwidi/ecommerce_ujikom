@extends('beranda.beranda')
@section('content')
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
    <!-- Featured Product Start -->
    <form action="{{ url('place-order')}}" method="POST">
        {{ csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal_transaksi">Tanggal</label>
                                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ Carbon\Carbon::now()->toDateString() }}" required>
                            </div>
                            <h6>Data Pembeli</h6>
                            <label>Nama Pengguna</label>
                            <input type="text" name="price" class="form-control" value="{{ Auth::user()->name}}" placeholder="price">
                            <label>Alamat</label>
                            <input type="text" name="price" class="form-control" value="{{ Auth::user()->address}}" placeholder="price">
                            <label>No Telephon</label>
                            <input type="text" name="price" class="form-control" value="{{ Auth::user()->phone}}" placeholder="price">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="cart-page-inner">
                        <h6>Detail Pesanan</h6>
                        <hr>
                        <table class="table table-bordered table-hover table-striped" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @php $total_harga = 0; @endphp
                                @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <img src="{{ asset('image/'. $item->produk->img) }}" width="100" height="100" alt="">
                                    </td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td align="right">Rp.{{ $item->produk->price }}</td>
                                    <td>{{$item->produk->price * $item->qty }}

                                    @php $total_harga = $total_harga +($item->produk->price * $item->qty) ; @endphp

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="px-2">Grand Total: <span class="float-end">Rp.{{ number_format($total_harga) }}</span></h4>

                        <hr>
                        <div class="form-group">
                            <label for="payment">Metode Pembayaran</label>
                            <select class="form-control" name="payment" id="payment" required>
                                <option value="cod">COD (Cash on Delivery)</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="checkout-btn">
                        <button class="btn btn-primary float-end" onclick="return confirm('Anda yakin akan Check Out ?');">Pesan Order</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
