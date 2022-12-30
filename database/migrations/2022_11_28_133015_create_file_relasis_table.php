<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileRelasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_relasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_realisasi');
            $table->string('nama');
            $table->string('file');
            //$table->enum('pic',['Akademik','Keuangan','P3M','PLK','Asdir1','Asdir2','BPMI','TIK','Laboran','Perpustakaan','D3Komputer','D3Hotel','D3Akuntansi','D3Administrasi','D4Perhotelan','D4Manajemen']);            
            $table->timestamps();

            $table->foreign('id_realisasi')->references('id')->on('realisasis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_relasis');
    }
}
