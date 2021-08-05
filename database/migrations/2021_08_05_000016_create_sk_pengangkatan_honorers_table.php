<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkPengangkatanHonorersTable extends Migration
{
    public function up()
    {
        Schema::create('sk_pengangkatan_honorers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat')->unique();
            $table->date('tgl_surat');
            $table->date('tmt_sk');
            $table->integer('masa_kerja');
            $table->integer('masa_kerja_bulan');
            $table->string('jenis_ptk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
