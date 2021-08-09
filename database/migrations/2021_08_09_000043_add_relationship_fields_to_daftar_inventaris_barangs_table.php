<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDaftarInventarisBarangsTable extends Migration
{
    public function up()
    {
        Schema::table('daftar_inventaris_barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_barang_id');
            $table->foreign('nama_barang_id', 'nama_barang_fk_4566327')->references('id')->on('daftar_nama_barangs');
            $table->unsignedBigInteger('daftar_ruangan_id');
            $table->foreign('daftar_ruangan_id', 'daftar_ruangan_fk_4566329')->references('id')->on('daftar_ruangans');
        });
    }
}
