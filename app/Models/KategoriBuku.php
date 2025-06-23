<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{

    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'id_kategori');
    }
}
