@extends('beranda.beranda')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Sukses Check Out</h3>
                    <h5>
                    
                    @if($transaksis->status == 1)
                    @if($transaksis->photo)

                    <h4><label class="badge bg-success">Pesanan Anda Akan segera dikemas dan Akan Segera Dikirim</label>
                    <p>Estimasi pesanan sampai 3 hari </p></h4>
                    @else
                    Pesanan anda sudah sukses dicheck out. Selanjutnya untuk pembayaran, silahkan transfer ke rekening
                        <strong>Bank BNI Nomer Rekening: 87699-2348769-333</strong> 
                    @endif
                     @else

                    @if($transaksis->photo)
                    <p><label class="badge bg-warning">Pembayaran Anda Sedang Di Verifikasi</p>
                        @else
                        Pesanan anda sudah sukses dicheck out. Selanjutnya untuk pembayaran, silahkan transfer ke rekening
                        <strong>Bank BNI Nomer Rekening: 87699-2348769-333</strong>  dan Upload Bukti Pembayaran Anda
                    @endif
                    @endif

                    </h5>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6>Data Pembeli</h6>
                    <label>Nama Pengguna</label>
                    <input type="text" name="price" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nama Pengguna" disabled>
                    <label>No Telepon</label>
                    <input type="text" name="price" class="form-control" value="{{ Auth::user()->phone }}" placeholder="No Telepon" disabled>
                    <label>Alamat</label>
                    <input type="text" name="price" class="form-control" value="{{ Auth::user()->address }}" placeholder="Alamat" disabled>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_harga = 0; @endphp
                            @foreach($transaksis->transaksi_details as $item)
                            <tr>
                                <td>{{ $item->produk->nama }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp. {{ number_format($item->produk->price) }}</td>
                                <td><img src="{{ asset('image/'. $item->produk->img) }}" width="100" height="100" alt=""></td>
                                 
                            </tr>
                            <!-- jumlah total harga produk dan jumlah produk-->
                            @php 
                                $total_harga += $item->produk->price * $item->qty;
                            @endphp
                        </tbody>
                    </table>
                    <h4 class="px-2">Grand Total: <span class="float-end">Rp.{{ number_format($total_harga) }}</span></h4>
                    
                    <!-- user dapat menulis ulasan produk yang sudah dibeli -->
                    @if($transaksis->status == 1)
                    <a class="btn btn-primary" href="{{ route('ulasan.create', $item->produk_id) }}">Beri Ulasan Produk</a>
                    @endif

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
