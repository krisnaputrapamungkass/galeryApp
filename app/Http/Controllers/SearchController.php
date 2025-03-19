<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\AlbumFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if (Auth::check()) {
            $search = request('search'); // Ambil input pencarian dari request

            $album = AlbumFoto::where('users_id', Auth::user()->id)->get();

            $fotos = Foto::with('user', 'likes.user')
                ->where('status', "1")
                ->when($search, function ($query) use ($search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('judul', 'like', "%$search%")
                            ->orWhere('deskripsi', 'like', "%$search%")
                            ->orWhereDate('created_at', $search)
                            ->orWhereHas('user', function ($q) use ($search) { // Cari berdasarkan username
                                $q->where('name', 'like', "%$search%");
                            });
                    });
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $search = request('search'); // Ambil input pencarian dari request

            $album = AlbumFoto::where('users_id', Auth::user()->id)->get();

            $fotos = Foto::with('user', 'likes.user')
                ->where('status', "1")
                ->when($search, function ($query) use ($search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('judul', 'like', "%$search%")
                            ->orWhere('deskripsi', 'like', "%$search%")
                            ->orWhereDate('created_at', $search)
                            ->orWhereHas('user', function ($q) use ($search) { // Cari berdasarkan username
                                $q->where('name', 'like', "%$search%");
                            });
                    });
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // For non-AJAX requests, you could return a view here
        return view('beranda', compact('album', 'fotos'));
    }
}
