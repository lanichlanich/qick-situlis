<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePangkatGolongansTable extends Migration
{
    public function up()
    {
        Schema::create('pangkat_golongans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pangkat');
            $table->string('golongan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
