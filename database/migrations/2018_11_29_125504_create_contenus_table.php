<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('livre_id')->unsigned();
            $table->foreign('livre_id')->references('id')->on('livres');
            $table->integer('position')->default(0); // Position (page) du contenu dans le livre
            $table->integer('disposition_id')->unsigned();
            $table->foreign('disposition_id')->references('id')->on('dispositions');
            $table->integer('langue_id')->unsigned();
            $table->foreign('langue_id')->references('id')->on('langues');
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
        Schema::dropIfExists('contenus');
    }
}
