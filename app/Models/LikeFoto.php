<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'fotos_id');
    }
}