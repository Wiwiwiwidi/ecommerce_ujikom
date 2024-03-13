<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_detail extends Model
{
    protected $table = "transaksi_details";
    protected $fillable =["transaksi_id","produk_id","qty"];
    protected $id = 'id';

    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id', 'id');
    }
    public function transaksi()
	{
	      return $this->belongsTo(transaksi::class,'transaksi_id', 'id');
	}
}
