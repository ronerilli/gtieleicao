<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEleicoesTable extends Migration
{
    public function up()
    {
        Schema::create('eleicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('orgao');
            $table->integer('chapas');
            $table->integer('candidatos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleicoes');
    }
}
