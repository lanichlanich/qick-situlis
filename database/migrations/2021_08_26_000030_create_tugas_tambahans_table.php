<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTambahansTable extends Migration
{
    public function up()
    {
        Schema::create('tugas_tambahans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tugas_tambahan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
