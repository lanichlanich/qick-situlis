<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarBukusTable extends Migration
{
    public function up()
    {
        Schema::create('daftar_bukus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_buku');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
