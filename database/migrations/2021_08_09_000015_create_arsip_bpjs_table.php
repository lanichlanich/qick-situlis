<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipBpjsTable extends Migration
{
    public function up()
    {
        Schema::create('arsip_bpjs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_bpjs_pegawai');
            $table->string('no_bpjs_suami_istri')->nullable();
            $table->string('no_bpjs_anak_1')->nullable();
            $table->string('no_bpjs_anak_2')->nullable();
            $table->string('no_bpjs_anak_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
