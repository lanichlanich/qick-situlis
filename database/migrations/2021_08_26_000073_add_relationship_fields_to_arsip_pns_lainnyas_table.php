<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArsipPnsLainnyasTable extends Migration
{
    public function up()
    {
        Schema::table('arsip_pns_lainnyas', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_ptk_id');
            $table->foreign('nama_ptk_id', 'nama_ptk_fk_4539944')->references('id')->on('ptks');
        });
    }
}
