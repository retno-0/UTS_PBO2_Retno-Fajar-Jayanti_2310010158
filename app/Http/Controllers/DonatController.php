<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donat;

class DonatController extends Controller
{
    public function index()
    {
        $donat = Donat::all();
        return view('donat.index', compact('donat'));
    }

    public function create()
    {
        return view('donat.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required|numeric',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $harga = str_replace('.', '', $request->harga);

        // Buat record dulu supaya ada ID
        $donat = Donat::create([
            'nama' => $request->nama,
            'harga' => $harga,
            'stok' => $request->stok,
            'foto' => ''
        ]);

        // Nama file berdasarkan ID
        $namaFile = $donat->id . '.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/donat'), $namaFile);

        $donat->foto = $namaFile;
        $donat->save();

        return redirect()->route('donat.index')->with('success', 'Donat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $donat = Donat::findOrFail($id);
        return view('donat.edit', compact('donat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required|numeric',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $donat = Donat::findOrFail($id);
        $harga = str_replace('.', '', $request->harga);

        if ($request->hasFile('foto')) {
            $namaFile = $donat->id . '.' . $request->foto->extension();
            $path = public_path('uploads/donat/' . $donat->foto);

            if ($donat->foto && file_exists($path)) {
                unlink($path);
            }

            $request->foto->move(public_path('uploads/donat'), $namaFile);
            $donat->foto = $namaFile;
        }

        $donat->update([
            'nama' => $request->nama,
            'harga' => $harga,
            'stok' => $request->stok,
            'foto' => $donat->foto
        ]);

        return redirect()->route('donat.index')->with('success', 'Donat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $donat = Donat::findOrFail($id);
        $path = public_path('uploads/donat/' . $donat->foto);

        if ($donat->foto && file_exists($path)) {
            unlink($path);
        }

        $donat->delete();
        return redirect()->route('donat.index')->with('success', 'Donat berhasil dihapus!');
    }
}
