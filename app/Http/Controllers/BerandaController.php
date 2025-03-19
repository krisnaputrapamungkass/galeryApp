<?php

namespace App\Http\Controllers;

use App\Models\AlbumFoto;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $album = AlbumFoto::where('users_id', Auth::user()->id)->get();
            $fotos = Foto::with('user', 'likes.user')->where('status',"1")->orderBy('created_at', 'desc')->get();
        }else
        {
        $album = null;
        $fotos = Foto::with('user', 'likes.user')->where('status',"1")->orderBy('created_at', 'desc')->get();
        }

        return view('beranda', compact('album','fotos'));
    }
    

    public function getUpdate(Request $request)
{
    $foto = Foto::find($request->id);

    return response()->json([
        'likes' => $foto->likes->count(),
        'komentar' => $foto->komentar->count(),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
