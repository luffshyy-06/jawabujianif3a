<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('detailPinjam');
    
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('Nama_Buku', 'like', '%' . $search . '%');
        }
    
        $buku = $query->get();
    
        foreach ($buku as $book) {
            $book->is_returned = $book->detailPinjam->contains(function ($detail) {
                return is_null($detail->Tgl_Kembali); 
            });
        }
    
        return view('buku.index', compact('buku'));
    }
    
    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Buku' => 'required|string|max:255',
            'Penerbit' => 'required|string',
            'Pengarang' => 'required|string',
            'Jumlah' => 'required|integer',
        ]);

        Buku::create($request->all());
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);  
        $buku->update($request->all());
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Buku::destroy($id);  
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');;
    }
}

