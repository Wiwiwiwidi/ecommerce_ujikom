@include('Admin.template.body')
@include('Admin.template.content')

<!DOCTYPE html>
<html>
<body>
<div class="container-fluid">
    <div class="row">
         <div class="col-lg-8">
            <div class="checkout-inner">
              <div class="card">
                <div class="card-body">
                    <h4>Edit Data Produk</h4>
                <form method="POST" action="{{ url('produk/update', $produks->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                 <div class="row">
                 <div class="col-md-12 mb-3">
                 <label>Kategori</label>
                    <select class="form-select">
                        <option value="">{{ $produks->kategori->nama }}</option>
                    </select>
                </div>
                 <div class="col-md-6">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama .." value="{{ $produks->nama }}">
                </div>

                <div class="col-md-6">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $produks->price }}">
                </div>

                <div class="col-md-6">
                    <label>Qty</label>
                    <input type="number" name="prod_qty" class="form-control"  value="{{ $produks->prod_qty }}">
                </div>

                <div class="col-md-6">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control"  value="{{ $produks->deskripsi }}"></textarea>
                </div>

                <div class="col-md-6">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="img" placeholder="MASUKKAN GAMBAR" value="{{ $produks->img}}">
                    @if($produks->img)
                    <img src="{{ asset('image/'. $produks->img) }}"  width="100" height="100" alt="">
                    @endif
                </div>

                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-sm" value="Edit">
                    <a href="{{ url('produk') }}" class="btn btn-primary btn-sm">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
@endsection
