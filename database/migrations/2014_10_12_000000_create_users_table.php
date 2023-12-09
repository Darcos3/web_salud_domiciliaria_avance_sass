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
            $table->string('usuario');
            $table->integer('tipo'); // 0 profesional, 1 paciente
            $table->string('num_identificacion')->unique();
            $table->string('correo_electronico');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('estado'); // Nuevo - Antiguo
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
