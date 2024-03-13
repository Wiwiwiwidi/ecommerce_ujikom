<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    
    protected $table = "produks";
    protected $fillable =["nama","price","deskripsi","img","prod_qty","kategori_id"];
    protected $id = 'id';


    public function cart(): HasMany
    {
        return $this->hasMany(cart::class,'produk_id','id');
    }

    public function transaksi_detail() 
	{
	     return $this->hasMany(transaksi_detail::class,'produk_id', 'id');
	}

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id', 'id');
    }

    public function ulasan(): HasMany
    {
        return $this->hasMany(ulasan::class,'produk_id','id');
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(wishlist::class,'produk_id','id');
    }
}
