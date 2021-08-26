<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidikanTerakhirsTable extends Migration
{
    public function up()
    {
        Schema::create('pendidikan_terakhirs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pendidikan_terakhir');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
