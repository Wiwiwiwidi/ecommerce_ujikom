<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    protected $table = "wishlist";
    protected $fillable =[
        'tanggal',
        'user_id',
        'produk_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id', 'id');
    }
}
