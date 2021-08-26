<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipPnsLainnyasTable extends Migration
{
    public function up()
    {
        Schema::create('arsip_pns_lainnyas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_karpeg')->nullable();
            $table->string('no_karis_karsu')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
