<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombonganBelajarsTable extends Migration
{
    public function up()
    {
        Schema::create('rombongan_belajars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_rombel')->unique();
            $table->string('jurusan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
