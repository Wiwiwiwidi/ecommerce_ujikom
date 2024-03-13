@extends('beranda.beranda')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <strong>Upload Bukti Pembayaran</strong>
            </div>
            <!-- Tulisan Ketentuan Upload -->
            <div class="card-body">
                <p class="text-center">Sebelum mengunggah bukti pembayaran, mohon diperhatikan beberapa ketentuan berikut:</p>
                <ul>
                <h6><label class="badge bg-warning"><li>Pastikan foto bukti pembayaran yang Anda unggah jelas dan terbaca dengan baik.</li></h6></label>
               <h6> <label class="badge bg-warning"><li>Pastikan format file yang diunggah sesuai dengan ketentuan yang ditentukan (misalnya: JPG, PNG).</li></h6></label>
               <h6> <label class="badge bg-warning"><li>Setelah mengunggah, harap tunggu konfirmasi dari admin untuk memproses pembayaran Anda.</li></h6></label>
               <h6> <label class="badge bg-warning"><li>Jika terjadi kesalahan dalam proses upload bukti pembayaran, silakan Hubungi No Admin (+629765351236).</li></h6></label>

                </ul>
            </div>
            <!-- Form Upload -->
            <form method="post" action="{{ route('history.upload', $transaksis->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <input type="file" name="photo" class="form-control" id="photo" placeholder="Pilih Foto Bukti Pembayaran" accept="image/*">
                    @if($errors->has('photo'))
                        <div class="file-danger">
                            {{ $errors->first('photo')}}
                        </div>
                    @endif
                </div>
            </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Upload">
                    <a href="{{ url('my-history') }}" class="btn btn-primary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
