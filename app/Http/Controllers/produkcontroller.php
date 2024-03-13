<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\kategori;
use App\ulasan;
class produkcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // tampilan produk user
    public function index()
    {
        $produks = produk::orderBy('created_at', 'desc')->paginate(8);
        return view('produk.index', compact('produks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ulasan setiap produk berdasarkan id produk
        $ulasan = ulasan::where('produk_id', $id)->orderBy('created_at', 'desc')->paginate(3);
        $produks = produk::find($id);
        return view('produk.show', compact('produks','ulasan'));
    }

    // tampilan kategori user
    public function kategori()
    {
        $kategori = kategori::orderBy('created_at', 'desc')->paginate(8);
        return view('produk.kategori',compact('kategori'));
    }

    public function viewkategori($slug)
    {
        if(kategori::where('slug', $slug)->exists())
        {
            $kategori = kategori::where('slug', $slug)->first();
            $produks = produk::where('kategori_id', $kategori->id)->get();
            return view('/index', compact('kategori','produks'));
        }
       else{
        return redirect('/')->with('status','slug tidak ada');
       }
      
    }
    
}