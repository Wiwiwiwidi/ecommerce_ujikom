<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ulasan extends Model
{
    protected $table = "ulasans";
    protected $fillable =[
        'ulasan',
        'rating',
        'tanggal',
        'user_id',
        'produk_id',
    ];
    protected $id = 'id';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function produk()
    {
        return $this->belongsTo(produk::class,'produk_id','id');
    }
}
