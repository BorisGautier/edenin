<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textes', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->integer('langue_id')->unsigned();
            $table->foreign('langue_id')->references('id')->on('langues');
            $table->integer('contenu_id')->unsigned();
            $table->foreign('contenu_id')->references('id')->on('contenus');
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
        Schema::dropIfExists('textes');
    }
}
