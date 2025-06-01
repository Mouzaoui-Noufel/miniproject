<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmActeurTable extends Migration
{
    public function up()
    {
        Schema::create('film_acteur', function (Blueprint $table) {
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('acteur_id');
            $table->string('role')->nullable();

            $table->primary(['film_id', 'acteur_id']);

            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('acteur_id')->references('id')->on('acteurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('film_acteur');
    }
}
