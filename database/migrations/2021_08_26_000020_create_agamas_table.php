<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgamasTable extends Migration
{
    public function up()
    {
        Schema::create('agamas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agama');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
