<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatPenyimpananBukusTable extends Migration
{
    public function up()
    {
        Schema::create('tempat_penyimpanan_bukus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tempat_penyimpaanan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
