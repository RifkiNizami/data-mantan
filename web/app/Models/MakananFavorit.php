<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakananFavorit extends Model
{
    protected $table = 'makanan_favorit';

    protected $fillable = [
        'nama_makanan',
        'deskripsi',
    ];
}
