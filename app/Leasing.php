<?php

namespace jlma;

use Illuminate\Database\Eloquent\Model;

class Leasing extends Model
{
    //
    protected $table = "location" ;

    protected $fillable = [
        'nom_locataire' , 'prenom_locataire' , 'date_naiss_locataire' ,
        'slug_vehicule', 'lieu_recup_vehicule', 'lieu_circulation',
        'date_hr_debut_loc' , 'date_hr_fin_loc' , 'objet_location' ,
        'assurance' , 'type_locataire'
    ];

}
