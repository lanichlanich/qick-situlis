<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarInventarisBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('daftar_inventaris_barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
