<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenghasilansTable extends Migration
{
    public function up()
    {
        Schema::create('penghasilans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('penghasilan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
