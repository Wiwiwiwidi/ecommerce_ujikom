@include('Admin.template.body')
@include('Admin.template.content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
            </nav>
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
                                <td>{{ $item->qty}}</td>
                                <td>Rp. {{ number_format($item->produk->price) }}</td>
                                <td><img src="{{ asset('image/'. $item->produk->img) }}" width="100" height="100" alt=""></td>
                            </tr>
                            @php 
                                $total_harga += $item->produk->price * $item->qty;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="px-2">Grand Total:<span class="float-end">{{ $total_harga }}</span></h4>
                    <div class="mt-5 px-2">
                        <label for="">Order Status</label>
                        <form action="{{ url('update-history/'. $transaksis->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="form-select" name="status_history">
                                <option {{ $transaksis->status== '0'? 'selected':''}} value='0'>Sudah Pesan & Belum Dibayar</option>
                                <option {{ $transaksis->status== '1'? 'selected':''}} value='1'> Sudah Dibayar</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
