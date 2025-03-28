<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumFoto extends Model
{
    protected $fillable = ['album', 'deskripsi', 'users_id'];

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'album_id');
    }
}
