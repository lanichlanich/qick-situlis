<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArsipBpjsTable extends Migration
{
    public function up()
    {
        Schema::table('arsip_bpjs', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_ptk_id');
            $table->foreign('nama_ptk_id', 'nama_ptk_fk_4539900')->references('id')->on('ptks');
        });
    }
}
