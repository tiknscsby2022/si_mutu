<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_standar');
            $table->unsignedBigInteger('id_tahun_akademik');
            $table->string('indikator');
            $table->string('value');
            $table->string('pic');
            $table->timestamps();

            $table->foreign('id_standar')->references('id')->on('standars');
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
        Schema::dropIfExists('indikators');
    }
}
