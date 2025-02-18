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
        'users_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id',);
    }

    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'fotos_id');
    }

    public function komentar()
    {
        return $this->hasMany(KomentarFoto::class, 'fotos_id');
    }
}
