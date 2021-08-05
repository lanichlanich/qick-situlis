<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipNpwpsTable extends Migration
{
    public function up()
    {
        Schema::create('arsip_npwps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_npwp');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
