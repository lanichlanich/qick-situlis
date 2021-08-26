<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaansTable extends Migration
{
    public function up()
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pekerjaan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
