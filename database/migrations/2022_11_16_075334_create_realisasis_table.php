<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_indikator');
            $table->unsignedBigInteger('id_tahun_akademik');
            $table->string('value');            
            $table->string('pic');
            $table->string('alasan')->nullabel();
            $table->enum('status', ['0', '1', '2', '3',]);            
            $table->timestamps();

            $table->foreign('id_indikator')->references('id')->on('indikators');
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
        Schema::dropIfExists('realisasis');
    }
}
