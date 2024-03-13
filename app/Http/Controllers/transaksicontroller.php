<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use App\transaksi_detail;
use App\User;
use Carbon\Carbon;
use App\cart;
use App\produk;
use Illuminate\Support\Facades\Auth;
class transaksicontroller extends Controller
{
        public function index()
        {
            $old_cartitems = Cart::where('user_id', Auth::user()->id)->get();
            foreach($old_cartitems as $item)
            {
                if(!produk::where('id', $item->produk_id)->where('prod_qty','>=',$item->qty)->exists())
                {
                    $removeItem = Cart::where('user_id', Auth::id())->where('produk_id', $item->produk_id)->first();
                    $removeItem->delete(); 
                }
            }
            $cartitems = Cart::where('user_id', Auth::user()->id)->get();
            return view('transaksi.checkout',compact('cartitems'));
        }
    
        public function placeorder(Request $request)
        {
            
                $transaksi = new transaksi();
                $transaksi->user_id = Auth::id();
                $tanggalTransaksi = Carbon::now();
                $transaksi->tanggal_transaksi = $tanggalTransaksi;
                $transaksi->status = 0;
                $transaksi->photo = 0;
                $total= 0;
                $cartitems_total = Cart::where('user_id', Auth::id())->get();
                foreach($cartitems_total as $prod)
                {
                    $total += $prod->produk->price;

                }
                $transaksi->total_harga = $total;
                
                $transaksi->kode_unik = mt_rand(100, 999);
                $transaksi->save();

                $cartitems = cart::where('user_id', Auth::id())->get();

                
                foreach ($cartitems as $item) 
                {
                        transaksi_detail::create([
                            'transaksi_id' => $transaksi->id,
                            'produk_id' => $item->produk_id,
                            'qty' => $item->qty,
                            'price' => $item->produk->price,
                        ]);
                        
                        // mengurangi produk= jumlah qty 
                        $prod = produk::where('id', $item->produk_id)->first();
                        $prod->prod_qty = $prod->prod_qty -= $item->qty;
                        $prod->update();
                }
                
                
	// //jumlah total
    // $transaksi = transaksi::where('user_id', Auth::id())->first();
    // $transaksi->total_harga = $transaksi->total_harga+$produk->price*$request->qty;
    // $transaksi->update();

    $cartitems = Cart::where('user_id', Auth::id())->get();
    Cart::destroy($cartitems);
    
    cart::where('user_id', Auth::id())->delete();

    return redirect('/thankyou')->with('status',"order succes palced success");
}

    // cancel produk
    public function cancelorder($transaksi_id)
    {
        // Temukan transaksi berdasarkan ID
        $transaksi = transaksi::findOrFail($transaksi_id);

        // Temukan detail transaksi untuk transaksi ini
        $transaksi_detail = transaksi_detail::where('transaksi_id', $transaksi_id)->get();

        // Kembalikan stok produk yang sudah dibeli
        foreach ($transaksi_detail as $detail) {
            $produk = produk::findOrFail($detail->produk_id);
            $produk->prod_qty += $detail->qty; // Tambahkan kembali stok yang sudah dibeli
            $produk->save();
        }

        // Hapus transaksi dan detail transaksi
        $transaksi->delete();
        transaksi_detail::where('transaksi_id', $transaksi_id)->delete();

        return redirect(route('produk.index'))->with(['success' => 'Order Canceled Successfully']);
    }

}

