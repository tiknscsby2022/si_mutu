<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                        
            $table->string('password');
            $table->enum('role', ['Akademik','Keuangan','P3M','PLK','Asdir1','Asdir2','BPMI','TIK','Laboran','Perpustakaan','D3Komputer','D3Hotel','D3Akuntansi','D3Administrasi','D4Perhotelan','D4Manajemen']);
            $table->boolean('is_admin');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
