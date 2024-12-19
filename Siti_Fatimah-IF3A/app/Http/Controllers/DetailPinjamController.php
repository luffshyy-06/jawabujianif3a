<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjam;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;

class DetailPinjamController extends Controller
{
    public function index()
    {
        $detailPinjam = DetailPinjam::all();
        return view('detailpinjam.index', compact('detailPinjam'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();
        return view('detailpinjam.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_Anggota' => 'required|exists:anggota,ID_Anggota',
            'ID_Buku' => 'required|exists:buku,ID_Buku',
            'Tgl_Pinjam' => 'required|date',
            'Tgl_Kembali' => 'nullable|date'
        ]);

        $detailPinjam = new DetailPinjam($request->all());
        $detailPinjam->Denda = $detailPinjam->calculateDenda();
        $detailPinjam->save();

        return redirect()->route('detailpinjam.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function edit($No_Pinjam)
    {
        $detailPinjam = DetailPinjam::findOrFail($No_Pinjam);
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('detailpinjam.edit', compact('detailPinjam', 'anggota', 'buku'));
    }

    public function update(Request $request, $No_Pinjam)
    {
        $request->validate([
            'ID_Anggota' => 'required',
            'ID_Buku' => 'required',
            'Tgl_Kembali' => 'nullable|date',
        ]);

        $detailPinjam = DetailPinjam::findOrFail($No_Pinjam);
        $detailPinjam->ID_Anggota = $request->ID_Anggota;
        $detailPinjam->ID_Buku = $request->ID_Buku;
        $detailPinjam->Tgl_Kembali = $request->Tgl_Kembali;

        $detailPinjam->Denda = $detailPinjam->calculateDenda();

        $detailPinjam->save();

        return redirect()->route('detailpinjam.index')->with('success', 'Peminjaman berhasil diubah!');
    }

    public function destroy($id)
    {
        DetailPinjam::destroy($id);
        return redirect()->route('detailpinjam.index')->with('success', 'Peminjaman berhasil dihapus!');
    }
}