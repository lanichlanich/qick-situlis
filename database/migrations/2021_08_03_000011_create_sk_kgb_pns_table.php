<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkKgbPnsTable extends Migration
{
    public function up()
    {
        Schema::create('sk_kgb_pns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat')->unique();
            $table->date('tgl_surat');
            $table->date('tmt_kgb');
            $table->integer('masa_kerja_golongan');
            $table->integer('masa_kerja_bulan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
