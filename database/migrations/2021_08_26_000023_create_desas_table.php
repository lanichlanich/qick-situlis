<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesasTable extends Migration
{
    public function up()
    {
        Schema::create('desas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('desa');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
