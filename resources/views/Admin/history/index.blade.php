@include('Admin.template.body')
@include('Admin.template.content')
<section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h3>History Pemesanan User</h3>
                    </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                <th>Tanggal</th>
                                <th>Track Number</th>
                                <th>UserName</th>
                                <th>Status Transaksi</th>
                                <th>Bukti Transfer</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $item)
                            <tr>
                                <td>{{ $item->tanggal_transaksi }}</td>
                                <td>{{ $item->kode_unik }}</td>
                                <td>{{ $item->user->name }}</td> <!-- Menampilkan nama pembeli -->

                                <!-- <td>{{ $item->status == '0' ? 'pending':'complete' }}</td> -->
                                <td>
                                    @if($item->status == 0)
                                    Verifikasi Pembayaran
                                    @else
                                    Sudah dibayar 
                                    @endif
                                </td>
                                <td>
                                     @if($item->photo)
                                        <img src="{{ asset('image/'. $item->photo) }}" height="100" width="100" alt="">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                @if($item->photo)
                                    <a href="{{ url('Admin/view-history/'. $item->id )}}" class="btn btn-primary"><i class="fa fa-info"></i> Edit</a>
                                @else
                                    -
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
</div>
