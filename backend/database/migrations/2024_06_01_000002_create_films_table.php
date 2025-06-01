<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('resume')->nullable();
            $table->year('annee_sortie')->nullable();
            $table->integer('duree')->nullable();
            $table->string('genres')->nullable();
            $table->unsignedBigInteger('realisateur_id');
            $table->timestamps();

            $table->foreign('realisateur_id')->references('id')->on('realisateurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('films');
    }
}
