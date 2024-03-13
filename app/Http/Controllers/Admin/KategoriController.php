<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kategori;
class KategoriController extends Controller
{
    public function index()
    {
    	$kategoris = kategori::orderBy('created_at', 'desc')->paginate(8);
    	return view('Admin.kategori.index',compact('kategoris'));
    }

    public function add()
    {
    	
    	return view('Admin.kategori.add');
    }

    public function insert(Request $request)
    {
        $this->validate($request,[
    		'nama' => 'required|unique:kategoris,nama'        
    	]);

    	$kategori = new kategori();
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'. $ext;
            $file->move(public_path('uploads/gambar'),$filename);
            $kategori->img = $filename;
        }

        $kategori->nama = $request->input('nama');
        $kategori->slug = $request->input('slug');
        $kategori->deskripsi = $request->input('deskripsi');
        $kategori->save();
        return redirect('/kategoris')->with('status','kategori  berhasil ditambah');
    }

    public function destroy($id)
    {
        kategori::where('id',$id)->delete();
        return redirect('/kategoris');
    }

    
}
