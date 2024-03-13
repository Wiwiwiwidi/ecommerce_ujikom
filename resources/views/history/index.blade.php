
@extends('beranda.beranda')
@section('content')
<!-- Display success message if any -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-history"></i> Riwayat Pemesanan</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tracking Number</th>
                                    <th>Payment Mode</th>
                                    <th>Status Transaksi</th>
                                    <th>Detail</th>
                                    <th>Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksis as $item)
                                <tr>
                                    <td>{{ date('d M Y', strtotime ($item->tanggal_transaksi)) }}</td>
                                    <td>{{ $item->kode_unik }}</td>
                                    <td>{{ $item->payment }}</td>

                                    <td>
                                        @if($item->status == 0)
                                               Sudah Pesan & Belum dibayar
                                            @else
                                                Sudah dibayar
                                            @endif
                        
                                    </td>
                                    <td>
                                        <a href="{{ url('history/'. $item->id) }}" class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>
                                    </td>
                                    <td>
                                        @if ($item->payment = 'cod')
                                            @if (!$item->photo)
                                                <a href="/payment_proof/{{ $item->id }}" class="btn btn-danger">
                                                    <i class="fa fa-info"></i> Upload
                                                </a>
                                            @else
                                                <button class="btn btn-success" disabled>
                                                    <i class="fa fa-info"></i> Done
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mt-3">
            {{ $transaksis->links() }}
        </div>
    </div>
</div>
@endsection
