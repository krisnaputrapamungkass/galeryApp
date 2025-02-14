<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'komentar';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
