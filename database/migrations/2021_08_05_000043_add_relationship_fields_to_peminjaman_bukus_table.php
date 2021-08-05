<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPeminjamanBukusTable extends Migration
{
    public function up()
    {
        Schema::table('peminjaman_bukus', function (Blueprint $table) {
            $table->unsignedBigInteger('peminjam_buku_id');
            $table->foreign('peminjam_buku_id', 'peminjam_buku_fk_4540176')->references('id')->on('peminjam_bukus');
            $table->unsignedBigInteger('nama_buku_id');
            $table->foreign('nama_buku_id', 'nama_buku_fk_4540177')->references('id')->on('daftar_bukus');
            $table->unsignedBigInteger('tempat_penyimpanan_buku_id');
            $table->foreign('tempat_penyimpanan_buku_id', 'tempat_penyimpanan_buku_fk_4540178')->references('id')->on('tempat_penyimpanan_bukus');
        });
    }
}
