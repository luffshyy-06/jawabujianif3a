<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && $request->search != '') {
            $anggota = Anggota::where('Nama_Anggota', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $anggota = Anggota::all();
        }

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Anggota' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'Jurusan' => 'required|string',
            'Tgl_Daftar' => 'required|date',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'Nama_Anggota' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'Jurusan' => 'required|string',
            'Tgl_Daftar' => 'required|date',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus');
    }
}
