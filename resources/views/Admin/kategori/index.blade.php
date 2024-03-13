@include('Admin.template.body')
@include('Admin.template.content')

<section class="section">
    <h3>Data Kategori</h3>
                    <div class="card">
                        <div class="card-header">
                        <a href="add-kategori" class="nav-item nav-link">Tambah Kategori</a>
                    </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Deskripsi</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategoris as $kategoris)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategoris->nama }}</td>
                                    <td>{{ $kategoris->slug }}</td>
                                    <td>{{ $kategoris->deskripsi }}</td>
                                    <td>
                                    <img src="{{ asset('uploads/gambar/'.  $kategoris->img) }}" width="100px" alt="Image">
                                    </td>
                                    <td>
                                    <form action="{{ url('kategori/destroy', $kategoris->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ url('edit-kategori', $kategoris->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')" title="Hapus">Hapus</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

