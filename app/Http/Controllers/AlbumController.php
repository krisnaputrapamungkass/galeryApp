<?php

namespace App\Http\Controllers;

use App\Models\AlbumFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $valiation = $request->validate([
            'album' => 'required',
            'deskripsi' => 'required',
        ]);
        $valiation['users_id'] = Auth::user()->id;
        $album = AlbumFoto::create($valiation);

        if ($album) {
            return redirect()->route('beranda.index')->with('success', 'Album berhasil ditambahkan');
        } else {
            return redirect()->route('beranda.index')->with('error', 'Album gagal ditambahkan');
        }
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
