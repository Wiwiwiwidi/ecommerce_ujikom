<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\produk;
use App\kategori;

class ProdukAdminController extends Controller
{
    public function index()
    {
        $produks = produk::orderBy('created_at', 'desc')->paginate(8);
        return view('Admin.produk.index', compact('produks'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        return view ('Admin.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
    		'nama' => 'required',
    		'price' => 'required',
            'deskripsi'=>'required',
            'prod_qty' => 'required',
            'img' => 'required',
            'kategori_id'=>'required'
    	]);

        $produks =new produk();
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'. $ext;
            $file->move(public_path('image'),$filename);
            $produks->img = $filename;
        }

        $produks->nama = $request->input('nama');
    	$produks->price = $request->input('price');
        $produks->deskripsi = $request->input('deskripsi');
        $produks->prod_qty = $request->input('prod_qty');
        $produks->kategori_id = $request->input('kategori_id');  
    	$produks->save();
 
    	return redirect('/produk')->with(['status'=>'Barang  berhasil ditambahkan']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produks = produk::find($id);
        return view('produk.show', compact('produks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produks = produk::where('id', $id)->first();
        return view('Admin.produk.edit', compact('produks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produks = produk::find($id);
        if($request->hasFile('img'))
        {
            $path = 'assets/image/'. $produks->img;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'. $ext;
            $file->move(public_path('image'),$filename);
            $produks->img = $filename;
        }

        $produks->nama = $request->input('nama');
    	$produks->price = $request->input('price');
        $produks->deskripsi = $request->input('deskripsi');
        $produks->prod_qty = $request->input('prod_qty');
        $produks->update();
       
        return redirect('/produk')->with(['status'=> 'Barang berhasil di ubah']);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        produk::where('id',$id)->delete();
        return redirect('produk');
    }
}
