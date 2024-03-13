<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategoris";
    protected $fillable =["nama","slug","deskripsi","img"];

    public function produk(): HasMany
    {
        return $this->hasMany(produk::class,'kategori_id','id');
    }

}
