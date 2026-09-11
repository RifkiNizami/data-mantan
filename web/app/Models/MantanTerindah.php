<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MantanTerindah extends Model
{
    protected $table = 'mantan_terindah';

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'makanan_favorit',
    ];
}
