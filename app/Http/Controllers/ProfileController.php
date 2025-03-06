<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto = $request->file('foto');
        $fotoName = time() . "." . $foto->getClientOriginalExtension();

        


        $foto->move(public_path('/storage/img-profile'), $fotoName);
        return redirect()->route('profile')->with('success', 'Foto berhasil diupload');

        $user = User::find($id);
        $user->foto = $fotoName;
        $user->save();
    }
}
