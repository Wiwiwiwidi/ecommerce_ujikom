<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\transaksi;
use App\transaksi_detail;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // history user
    public function index()
    {
		$transaksis = transaksi::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(4);
    	return view('history.index', compact('transaksis'));
    }

	public function view($id)
	{
		// SEMENTARA KARENA ERROR
		$transaksis = transaksi::find($id);
	
		// Check if $transaksis is not null before accessing its properties
		if ($transaksis) {
			$transaksi_details = transaksi_detail::where('transaksi_id', $transaksis->id)->get();
			return view('history.view', compact('transaksis', 'transaksi_details'));
		} else {
			// Handle the case where no transaction with the specified ID is found
			return redirect()->back()->with('error', 'Transaction not found.');
		}
	}

	public function create($id){
        $transaksis = transaksi::find($id);
        return view('history.payment',compact('transaksis'));
    }
	
	public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpg,jpeg,png',
		],[
			'required'=>'anda harus mengunggah foto bukti pembayaran.',
			'image'=>'File yang anda unggah harus beruba gambar.',
			'mimes'=>'Format foto yang diperbolehkan hanya jpg,jpeg,png',

        ]);
        $transaksi = transaksi::find($id);
        $imgName = $request->photo->getClientOriginalName() . '-' . time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('image'), $imgName);
        $transaksi->photo = $imgName;
		$transaksi->status = 0;
        $transaksi->save();

        return redirect('/my-history')->with('success','Bukti pembayaran anda telah berhasil di unggah. Tunggu Verifikasi admin');
    }

//   profile user
    public function profile()
    {
    	$user = User::where('id', Auth::user()->id)->first();

    	return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
    	 $this->validate($request, [
            'password'  => 'confirmed',
        ]);

    	$user = User::where('id', Auth::user()->id)->first();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	if(!empty($request->password))
    	{
    		$user->password = Hash::make($request->password);
    	}
    	
    	$user->update();
		session()->flash('message', "Profile Berhasil diubah");
    	return redirect('/profile');
    }
    
}   
