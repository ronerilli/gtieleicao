<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToEleicoesTable extends Migration
{
    public function up()
    {
        Schema::table('eleicoes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
        });
    }

    public function down()
    {
        Schema::table('eleicoes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
