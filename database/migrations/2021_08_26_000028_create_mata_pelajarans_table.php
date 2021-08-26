<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaransTable extends Migration
{
    public function up()
    {
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mata_pelajararan');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
