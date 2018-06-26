<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTableLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('nom_locataire');
            $table->string('prenom_locataire');
            $table->date('date_naiss_locataire');
            $table->string('slug_vehicule');
            $table->string('lieu_recup_vehicule');
            $table->string('lieu_circulation');
            $table->dateTime('date_hr_debut_loc');
            $table->dateTime('date_hr_fin_loc');
            $table->string('objet_location');
            $table->string('assurance');
            $table->string('type_locataire');
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
        Schema::dropIfExists('location');
    }
}
