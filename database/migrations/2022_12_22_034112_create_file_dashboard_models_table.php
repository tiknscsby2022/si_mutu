<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileDashboardModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_dashboard_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun_akademik');
            $table->string('name');
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
        Schema::dropIfExists('file_dashboard_models');
    }
}
