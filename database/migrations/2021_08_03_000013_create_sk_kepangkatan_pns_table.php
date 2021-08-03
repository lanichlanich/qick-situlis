<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkKepangkatanPnsTable extends Migration
{
    public function up()
    {
        Schema::create('sk_kepangkatan_pns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat')->unique();
            $table->date('tgl_surat');
            $table->date('tmt_cpns');
            $table->integer('masa_kerja_golongan');
            $table->integer('masa_kerja_bulan');
            $table->string('pangkat_golongan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
