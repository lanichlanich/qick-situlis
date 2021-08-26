<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunsTable extends Migration
{
    public function up()
    {
        Schema::create('tahuns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tahun')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
