<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\produk;
use App\User;
use Illuminate\Support\Facades\Auth;
class cartcontroller extends Controller
{
    public function keranjang()
    {
        $keranjang = cart::with('produk')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        // $cartTotal = 0;
        // foreach ($keranjang as $item) {
        //     $cartTotal += $item->produk->price * $item->qty;
        // }
    
        return view('produk.cart', compact('keranjang'));
    }

    public function addToCart(Request $request, produk $produk)
    {      
        // Periksa apakah produk sudah ada di keranjang
        $cekcart = cart::where('user_id', Auth::id())
        ->where('produk_id', $produk->id)
        ->exists();

        // Jika produk sudah ada di keranjang, tampilkan pesan kesalahan
        if ($cekcart) {
        return redirect()->route('produk.show', ['id' => $produk->id])
        ->with('error', 'Produk sudah ada di keranjang.');
        }

        // Validasi stok
        if ($produk->prod_qty < $request->qty) {
            return redirect()->route('produk.show', ['id' => $produk->id])->with(['error' => 'Jumlah Melebihi Stok']);
        } else {
        // Logika untuk menambahkan barang ke keranjang
        $cartItem = cart::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
            'qty' => $request->qty,
        ]);
        }
        return redirect()->route('cart')->with('status', 'Item added to cart successfully');
    }
    

    public function update(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $cartItem = Cart::findOrFail($request->id);
        // Check if the requested quantity exceeds the available stock
        if ($request->qty > $cartItem->produk->prod_qty) {
            return back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

       // Update the quantity
        $cartItem->qty = $request->qty;
        $cartItem->save();

        return redirect()->route('cart')->with('status', 'Update Cart');;
    }

    
     public function remove($id)
    {
        $cartItem = cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart')->with('status', 'Item removed from cart');
    }

}
