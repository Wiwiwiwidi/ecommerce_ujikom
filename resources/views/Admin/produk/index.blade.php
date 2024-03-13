@include('Admin.template.body')
@include('Admin.template.content')
<!DOCTYPE html>
<html>

<body>
<section class="section">
                <h3>Data Produk</h3>
                    <div class="card">
                        <div class="card-header">
                        <a href="produk/create" class="nav-item nav-link">Tambah produk</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php $no = 1 ?>
                @foreach($produks as $p)
                    <tr>
                        <td>{{ $no++ }}</td>  
                        <td>{{ $p->kategori->nama }}</td>                                         
                        <td><p>{{ $p->nama }}</p></td>
                        <td>{{ $p->prod_qty }}</td>
                        <td>Rp.{{ number_format($p->price) }}</td>
                        <td>
                            <div class="img">
                                <a href="#"><img src="{{ asset('image/'. $p->img) }}" width=100px alt="Image"></a>
                            </div>
                        </td> 
                        <td>
                            <form action="{{ url('produk/destroy', $p->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="{{ url('produk/edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')" title="Hapus">Hapus</button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
