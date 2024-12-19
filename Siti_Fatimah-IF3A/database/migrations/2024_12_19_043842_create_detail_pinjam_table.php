<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPinjamTable extends Migration
{
    public function up()
    {
        Schema::create('detail_pinjam', function (Blueprint $table) {
            $table->string('No_Pinjam')->unique();
            $table->unsignedBigInteger('ID_Anggota');
            $table->foreign('ID_Anggota')->references('ID_Anggota')->on('anggota')->onDelete('cascade');
            
            $table->unsignedBigInteger('ID_Buku');
            $table->foreign('ID_Buku')->references('ID_Buku')->on('buku')->onDelete('cascade');
            
            $table->date('Tgl_Pinjam');
            $table->date('Tgl_Kembali')->nullable();  
            $table->integer('Denda')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pinjam');
    }
}
