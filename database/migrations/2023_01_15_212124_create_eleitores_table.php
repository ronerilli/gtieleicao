// arquivo: database/migrations/create_eleitores_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEleitoresTable extends Migration
{
    public function up()
    {
        Schema::create('eleitores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('matricula');
            $table->boolean('votou')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleitores');
    }
}
