<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAjaransTable extends Migration
{
    public function up()
    {
        Schema::create('tahun_ajarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tahun_ajaran')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
