<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeningkatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peningkatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun_akademik');
            $table->unsignedBigInteger('id_realisasi');            
            $table->string('file');        
            $table->timestamps();

            $table->foreign('id_tahun_akademik')->references('id')->on('tahun_akademiks');
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
        Schema::dropIfExists('peningkatans');
    }
}
