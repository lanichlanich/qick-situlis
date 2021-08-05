<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSkCpnsTable extends Migration
{
    public function up()
    {
        Schema::table('sk_cpns', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_ptk_id');
            $table->foreign('nama_ptk_id', 'nama_ptk_fk_4526531')->references('id')->on('ptks');
        });
    }
}
