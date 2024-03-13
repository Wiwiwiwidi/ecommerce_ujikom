<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = "carts";
    protected $fillable =["user_id","produk_id","qty"];
    protected $id = 'id';

    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    
}
