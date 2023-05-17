<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->text('biografia')->nullable();
            $table->string('foto')->nullable();
            $table->foreign('chapa_id')->references('id')->on('chapas');
            $table->foreign('eleicao_id')->references('id')->on('eleicoes');
            $table->integer('votos_recebidos')->default(0);
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
        Schema::dropIfExists('candidatos');
    }
};
