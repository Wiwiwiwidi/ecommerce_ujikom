<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = "transaksis";
    protected $fillable =[
        'user_id',
        'tanggal_transaksi',
        'status',
        'photo',
        'total_harga',
        'kode_unik',
        'payment',
    ];
    protected $id = 'id';

    public function transaksi_details()
    {
        return $this->hasMany(transaksi_detail::class, 'transaksi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
