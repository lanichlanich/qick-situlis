<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDaftarSiswasTable extends Migration
{
    public function up()
    {
        Schema::table('daftar_siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('asal_sekolah_id');
            $table->foreign('asal_sekolah_id', 'asal_sekolah_fk_4723286')->references('id')->on('smp_mts');
        });
    }
}
