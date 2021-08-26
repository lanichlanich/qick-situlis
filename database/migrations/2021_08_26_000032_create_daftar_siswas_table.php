<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('daftar_siswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_induk')->unique();
            $table->string('nama_siswa');
            $table->string('nisn')->unique();
            $table->date('tgl_masuk');
            $table->string('status');
            $table->date('tgl_keluar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
