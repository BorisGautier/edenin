<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_has_livres_id')->unsigned();
            $table->foreign('users_has_livres_id')->references('id')->on('users_has_livres');
            $table->integer('user_id')->unsigned();
            $table->integer('destinataire_id')->unsigned(); // Identifiant de l'utilisateur qui recoit le livre
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('partages');
    }
}
