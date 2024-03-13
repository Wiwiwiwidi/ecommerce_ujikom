<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\produk;
use App\User;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            if(Auth::user()->role == 'admin'){
                session()->flash('message', "Selamat Datang di Dashboard Admin");
                return view ('Admin.dashboard');
             } elseif(Auth::user()->role == 'user'){
                    $produks = produk::paginate(20);
                    return view ('main', compact('produks'));
                }else{
                    abort(404, 'Tampilan dengan Role' . Auth::user()->role. 'tidak ada');

                }
            }else{
                return redirect()->route('/login');
            }
        }
    // public function search(Request $request){
    //     $search = $request->search;
    //     $produks = DB::table('produks')->where('nama', 'like', "%" . $search . "%")->paginate();
    //     return view('produk.index', compact('produks'));
    // }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $produks = produk::where('nama', 'LIKE', "%$keyword%")
            ->orWhere('deskripsi', 'LIKE', "%$keyword%")
            ->get();
        $message = $produks->isEmpty() ? 'Maaf, produk tidak ditemukan.' : null;

        return view('produk.index', compact('produks'));
    }
        }
