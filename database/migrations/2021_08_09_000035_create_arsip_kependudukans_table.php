<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipKependudukansTable extends Migration
{
    public function up()
    {
        Schema::create('arsip_kependudukans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_nik');
            $table->string('no_kk')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
