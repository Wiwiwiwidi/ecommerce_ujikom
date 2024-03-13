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
                    <h3>Tambah Kategori</h3>
                </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('insert-kategori')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                        @error('nama')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                        @error('slug')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"></textarea>
                                        @error('deskripsi')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label>Image</label>
                                    <input type="file" name="img" class="form-control">
                                        @error('img')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                     <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Simpan">
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

