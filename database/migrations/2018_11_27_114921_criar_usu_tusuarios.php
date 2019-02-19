<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarUsuTusuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_tusuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('matricula');
            $table->string('cpf', 11)->unique();
            $table->string('password');
            $table->string('fone',11)->nullable();
            $table->string('code')->nullable();
            $table->boolean('ativo')->default(0);
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
        Schema::dropIfExists('usu_tusuarios');
    }
}
