<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'users_id',
        'foto',
        'judul',
        'deskripsi',
        'status',
        'album_id',
    ];
}
