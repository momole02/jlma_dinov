<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableProprietaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietaire', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('nom');
            $table->string('prenom');
            $table->string('mail');
            $table->string('contact');
            $table->string('lieu_habitation');
            $table->date('date_naissance');
            $table->string('civilite');
            $table->string('pseudo');
            $table->string('mot_passe_hash');
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
        Schema::dropIfExists('proprietaire');
    }
}
