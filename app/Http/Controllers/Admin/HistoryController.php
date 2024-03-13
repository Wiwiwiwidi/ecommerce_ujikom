<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\transaksi;
use App\transaksi_detail;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // public function index()
    // {
    // 	$transaksis = transaksi::where('status','0')->orderBy('created_at', 'desc')->get();
    // 	return view('Admin.history.index', compact('transaksis'));
    // }

    public function index()
    {
        $transaksis = transaksi::with('user') // Memuat informasi pengguna untuk setiap transaksi
                        ->where('status', '0')
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        return view('Admin.history.index', compact('transaksis'));
    }
    
    public function view($id)
    {
    	$transaksis = transaksi::where('id', $id)->first();
    	$transaksi_details = transaksi_detail::where('transaksi_id', $transaksis->id)->get();
     	return view('Admin.history.view', compact('transaksis','transaksi_details'));
    }

    public function updatehistory(Request $request, $id)
    {
        $transaksis = transaksi::find($id);
        $transaksis->status = $request->input('status_history');
        $transaksis->status = 1;

        $transaksis->update();

        return redirect('history')->with('success',"Status Berhasil Diubah");
    }
}

