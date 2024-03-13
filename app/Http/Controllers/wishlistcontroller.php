<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\User;
use App\wishlist;
use Illuminate\Support\Facades\Auth;

class wishlistcontroller extends Controller
{
    public function wishlist()
    {
        $wishlist = wishlist::with('produk')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('produk.wishlist', compact('wishlist'));
    }

    public function addwishlist(Request $request, produk $produk)
    { 
        
        // periksa apakah produk sudah ada di wishlist
        $cekwishlist = wishlist::where('user_id',Auth::id())->where('produk_id', $produk->id)->first();
        if( $cekwishlist){
            return redirect()->route('produk.show', ['id' => $produk->id])->with('warning', 'produk tersebut sudah ada di wishlist Anda');
        }else{
        // Logika untuk menambahkan produk ke wishlist
        $wishlist = wishlist::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
        ]);
        }
        return redirect()->route('produk.show', ['id' => $produk->id])->with('success', 'produk berhasil ditambakan  ke wishlist Anda!');
     }

    public function destroy ($id)
    {
        $wishlist = wishlist::findOrFail($id);
        $wishlist->delete();

        return redirect()->route('wishlist')->with('status', 'Item removed from wishlist');
    }
}
