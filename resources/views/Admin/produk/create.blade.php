@include('Admin.template.body')
@include('Admin.template.content')

<!DOCTYPE html>
<html>

<body>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Produk</h3>
                </div>
                <form method="post" action="{{ url('produk/store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        <select class="form-select" name="kategori_id">
                                        <option value="">Select Kategori</option>
                                        @foreach($kategori as $item)
                                           <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama ..">

                                        @error('nama')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                        <label for="prod_qty">Qty</label>
                                        <input type="number" name="prod_qty" class="form-control" placeholder="Qty">

                                        @error('prod_qty')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="Price">

                                        @error('price')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi barang"></textarea>

                                        @error('deskripsi')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                        <label for="img">Photo</label>
                                        <input type="file" name="img" class="form-control" placeholder="Photo">

                                        @error('img')
                                            <div class="file-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    </div>

                                <div class="col-md-6 col-12">
                                     <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Simpan">
                                        <a href="/produk" class="btn btn-primary">Kembali</a>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
