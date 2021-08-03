<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarsTable extends Migration
{
    public function up()
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat')->unique();
            $table->date('tgl_surat');
            $table->string('keterangan');
            $table->string('tujuan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
