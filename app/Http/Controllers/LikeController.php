<?php

namespace App\Http\Controllers;

use App\Models\AlbumFoto;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index()
    {
            $album = AlbumFoto::where('users_id', Auth::id())->get();
            
            // Ambil hanya foto yang sudah di-like oleh user yang login
            $fotos = Foto::with(['user', 'likes.user'])
                ->whereHas('likes', function ($query) {
                    $query->where('users_id', Auth::id());
                })
                ->where('status', "1")
                ->orderBy('created_at', 'desc')
                ->get();
            return view('like', compact('album', 'fotos'));
    }
}