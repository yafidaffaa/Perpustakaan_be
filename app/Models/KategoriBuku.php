<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'id_kategori');
    }
}
