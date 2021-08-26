<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModaTransportasisTable extends Migration
{
    public function up()
    {
        Schema::create('moda_transportasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('moda_transportasi');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
