<?php

namespace jlma;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table='proprietaire';

    protected $fillable = ['nom','prenom','mail','contact','lieu_habitation','date_naissance','civilite','pseudo',
        'mot_passe_hash'];

    //
}
