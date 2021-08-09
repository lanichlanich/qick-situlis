<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanBukusTable extends Migration
{
    public function up()
    {
        Schema::create('peminjaman_bukus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah_pinjam');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_pengembalian');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
