<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\ulasan;
use Carbon\Carbon;
date_default_timezone_set('Asia/Jakarta');

class ulasancontroller extends Controller
{
    public function create($produk_id)
    {
        $produk = produk::findOrFail($produk_id);
        // Memuat ulasan yang terkait dengan produk yang dipilih
        $ulasan = ulasan::where('produk_id', $produk_id)->orderBy('created_at', 'desc')->paginate(4);
        return view('produk.ulasan', compact('produk', 'ulasan'));
    }
        
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'ulasan' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Proses penyimpanan ulasan ke dalam database
        ulasan::create([
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
            'tanggal' => $request->tanggal,

            'user_id' => Auth::id(),
            'produk_id' => $request->produk_id,
        ]);

        // Setelah ulasan disimpan, Anda bisa melakukan redirect atau menampilkan pesan sukses
        return redirect()->back()->with('success', 'Ulasan berhasil disimpan.');
    }

    }

