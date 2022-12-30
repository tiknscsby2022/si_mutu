<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilRekomendasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun_akademik');            ;
            $table->enum('jenis_file', ['Undangan', 'Daftar Hadir', 'Notulensi Rapat', 'Dokumentasi', 'Dokumen RTL']);
            $table->string('file');
            $table->timestamps();

            $table->foreign('id_tahun_akademik')->references('id')->on('tahun_akademiks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_rekomendasis');
    }
}
