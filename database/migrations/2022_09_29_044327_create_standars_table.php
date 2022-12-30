<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aspek');
            $table->string('standar');
            $table->string('file_tautan');
            $table->timestamps();

            $table->foreign('id_aspek')->references('id')->on('aspeks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standars');
    }
}
