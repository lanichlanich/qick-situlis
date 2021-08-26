<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahasasTable extends Migration
{
    public function up()
    {
        Schema::create('bahasas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bahasa');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
