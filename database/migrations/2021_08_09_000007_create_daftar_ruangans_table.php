<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarRuangansTable extends Migration
{
    public function up()
    {
        Schema::create('daftar_ruangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_ruangan');
            $table->string('kondisi_ruangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
