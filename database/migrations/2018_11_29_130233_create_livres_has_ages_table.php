<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivresHasAgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres_has_ages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('livre_id')->unsigned();
            $table->foreign('livre_id')->references('id')->on('livres');
            $table->integer('age_id')->unsigned();
            $table->foreign('age_id')->references('id')->on('ages');
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
        Schema::dropIfExists('livres_has_ages');
    }
}
