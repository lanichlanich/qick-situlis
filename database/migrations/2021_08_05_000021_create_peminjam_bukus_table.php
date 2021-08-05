<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamBukusTable extends Migration
{
    public function up()
    {
        Schema::create('peminjam_bukus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_peminjam');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
