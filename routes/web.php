<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produkcontroller;
use App\Http\Controllers\cartcontroller;
use App\Http\Controllers\transaksicontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ProdukAdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ulasancontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});
 

        Auth::routes(['verify' => true]);
        Route::get('/home', 'HomeController@index')->name('home');

        // route profil
        Route::get('/profile', 'UserController@profile');
        Route::post('/profile', 'UserController@update');
        // route searching
        Route::get('/search', [HomeController::class, 'search'])->name('search');

        // hak akses admin
        Route::group(['middleware' => ['auth','cekrole:admin']], function () {
            Route::get('/main', 'maincontroller@index')->name('main');

        // route produk
        Route::get('produk',[ProdukAdminController::class,'index']);
        route::get('produk/create', [ProdukAdminController::class,'create']);
        route::post('produk/store',[ProdukAdminController::class,'store']);
        route::get('produk/edit/{id}',[ProdukAdminController::class,'edit']);
        route::put('produk/update/{id}',[ProdukAdminController::class,'update']);
        route::delete('produk/destroy/{id}',[ProdukAdminController::class,'destroy']);
        Route::get('produk/{id}/show', 'produkcontroller@show')->name('produk.show');

        // route history
        Route::get('history', [HistoryController::class, 'index']);
        Route::get('Admin/view-history/{id}', [HistoryController::class, 'view']);
        Route::put('update-history/{id}', [HistoryController::class, 'updatehistory']);

        // route kategori
        Route::get('kategoris', 'Admin\KategoriController@index');
        Route::get('add-kategori', 'Admin\KategoriController@add');
        Route::post('insert-kategori', 'Admin\KategoriController@insert');
        route::delete('kategori/destroy/{id}','Admin\KategoriController@destroy');
        });

        // hak akses user
        Route::middleware('auth')->group(function () {
        Route::get('my-produk',[produkcontroller::class,'index']);
        Route::get('produk/{id}/show', 'produkcontroller@show')->name('produk.show');
        Route::get('keranjang', 'cartcontroller@keranjang')->name('cart');
        });
        
        // route cart
        Route::middleware('auth')->group(function () {
        Route::get('add-to-cart/{id}', 'cartcontroller@addToCart')->name('add.to.cart');
        Route::post('/cart/update', [cartcontroller::class, 'update'])->name('cart.update');
        Route::post('cart/add/{produk}', 'cartcontroller@addToCart')->name('cart.add');
        Route::delete('/cart/remove/{id}', 'cartcontroller@remove')->name('cart.remove');
         });
        
        //  route transaksi
        Route::middleware('auth')->group(function () {
        Route::get('/checkout', [transaksicontroller::class, 'index']);
        Route::post('/place-order', [transaksicontroller::class, 'placeorder']);
         });
        
        //  route history
        Route::middleware('auth')->group(function () {
        Route::get('my-history', [UserController::class, 'index']);
        Route::get('history/{id}', [UserController::class, 'view']);
        Route::get('payment_proof/{id}', 'UserController@create');
        Route::put('upload/{id}', 'UserController@upload')->name('history.upload');
        });

        // route kategori
        Route::middleware('auth')->group(function () {
        Route::get('kategori', [produkcontroller::class,'kategori']);
        Route::get('view-kategori/{slug}', [produkcontroller::class,'viewkategori']);
        });


        //route ulasan
        Route::middleware('auth')->group(function () {
        Route::get('ulasan/create/{id}', [ulasancontroller::class,'create'])->name('ulasan.create');
        Route::post('ulasan/store',[ulasancontroller::class,'store'])->name('ulasan.store')->middleware('auth');
        });

        Route::middleware('auth')->group(function () {
        Route::get('wishlist', 'wishlistcontroller@wishlist')->name('wishlist');
        Route::post('wishlist/add/{produk}','wishlistcontroller@addwishlist')->name('wishlist.add');
        Route::delete('/wishlist/destroy/{id}','wishlistcontroller@destroy')->name('wishlist.destroy');
        });

        Route::view('/thankyou','thankyou');

         // Route::delete('transaksi/{transaksi}/cancelorder', 'transaksicontroller@cancelorder')->name('transaksi.cancelorder');
        // Route::delete('/transaksi/{id}/cancel', 'transaksicontroller@cancelOrder')->name('transaksi.cancel');
        