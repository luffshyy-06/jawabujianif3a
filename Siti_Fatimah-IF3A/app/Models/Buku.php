<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'ID_Buku';

    protected $fillable = [
        'Nama_Buku', 'Penerbit', 'Pengarang', 'Jumlah'
    ];

    public function detailPinjam()
    {
        return $this->hasMany(DetailPinjam::class, 'ID_Buku');
    }

    public function reduceJumlah($quantity = 1)
    {
        $this->Jumlah -= $quantity;
        $this->save();
    }

    public function increaseJumlah($quantity = 1)
    {
        $this->Jumlah += $quantity;
        $this->save();
    }
}

