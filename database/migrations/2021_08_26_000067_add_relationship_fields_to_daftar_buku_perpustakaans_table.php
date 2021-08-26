<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDaftarBukuPerpustakaansTable extends Migration
{
    public function up()
    {
        Schema::table('daftar_buku_perpustakaans', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_buku_id');
            $table->foreign('nama_buku_id', 'nama_buku_fk_4540152')->references('id')->on('daftar_bukus');
            $table->unsignedBigInteger('tempat_penyimpanan_id');
            $table->foreign('tempat_penyimpanan_id', 'tempat_penyimpanan_fk_4540154')->references('id')->on('tempat_penyimpanan_bukus');
        });
    }
}
