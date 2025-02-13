<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
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
        $valiatio = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'album_id' => 'required',
        ]);

        $foto = $request->file('foto');
        $nama_foto = time() . "." . $foto->getClientOriginalExtension();
        $foto_upload = $foto->move(public_path('/storage/images'), $nama_foto);

        if ($foto_upload) {
            $valiatio['foto'] = $nama_foto;
            $valiatio['users_id'] = Auth::user()->id;
            $fotoSimpan = Foto::create($valiatio);

            if ($fotoSimpan) {
                return redirect()->route('beranda.index')->with('success', 'Foto berhasil ditambahkan');
            } else {
                return redirect()->route('beranda.index')->with('error', 'Foto gagal ditambahkan');
            }
        } else {
            return redirect()->route('beranda.index')->with('error', 'Foto gagal ditambahkan');
        }
    }

    public function like(Request $request)
    {
        $validasi = $request->validate([
            'id' => 'required',
        ]);

        $simpan = LikeFoto::create([
            'fotos_id' => $request->id,
            'users_id' => Auth::user()->id,
        ]);
        
        if ($simpan) {
            return response()->json([
                'success' => true,
                'message' => 'Like berhasil',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Like gagal',
            ]);
        }
    }

    public function unlike(Request $request)
    {
        $validasi = $request->validate([
            'id' => 'required',
        ]);

        $findData = LikeFoto::where('fotos_id', $request->id)->where('users_id', Auth::user()->id)->first();

        $simpan = $findData->delete();
        
        if ($simpan) {
            return response()->json([
                'success' => true,
                'message' => 'Unlike berhasil',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unlike gagal',
            ]);
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
