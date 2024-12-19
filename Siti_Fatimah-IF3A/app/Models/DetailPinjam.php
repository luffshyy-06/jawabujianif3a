<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{
    use HasFactory;

    protected $table = 'detail_pinjam';
    protected $primaryKey = 'No_Pinjam';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Anggota', 'ID_Buku', 'Tgl_Pinjam', 'Tgl_Kembali', 'Denda'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detailPinjam) {
            if (empty($detailPinjam->No_Pinjam)) {
                $lastRecord = self::orderBy('No_Pinjam', 'desc')->first();
                $lastNoPinjam = $lastRecord ? (int) substr($lastRecord->No_Pinjam, 4) : 0;
                $newNoPinjam = 'PNJM' . str_pad($lastNoPinjam + 1, 3, '0', STR_PAD_LEFT);
                $detailPinjam->No_Pinjam = $newNoPinjam;
            }
        });

        static::created(function ($detailPinjam) {
            $buku = Buku::find($detailPinjam->ID_Buku);
            if ($buku) {
                $buku->reduceJumlah();
            }
        });

        static::updated(function ($detailPinjam) {
            if ($detailPinjam->getOriginal('Tgl_Kembali') === null && $detailPinjam->Tgl_Kembali) {
                $buku = Buku::find($detailPinjam->ID_Buku);
                if ($buku) {
                    $buku->increaseJumlah();
                }
            }
        });
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'ID_Anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'ID_Buku');
    }

    public function calculateDenda()
    {
        if ($this->Tgl_Kembali) {
            $tglKembali = Carbon::parse($this->Tgl_Kembali);
            $tglHarusKembali = Carbon::parse($this->Tgl_Pinjam)->addDays(3);

            if ($tglKembali->gt($tglHarusKembali)) {
                $selisihHari = $tglHarusKembali->diffInDays($tglKembali);

                $denda = 10000;
                $extraDays = $selisihHari - 3;

                if ($extraDays > 0) {
                    $denda += ceil($extraDays / 3) * 5000;
                }

                return $denda;
            }
        }

        return 0;
    }  
}
