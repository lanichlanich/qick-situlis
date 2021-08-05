<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarBukuPerpustakaansTable extends Migration
{
    public function up()
    {
        Schema::create('daftar_buku_perpustakaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
