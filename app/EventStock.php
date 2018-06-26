<?php

/*
 * EventStock.php
 *
 * Gère les évenements et les notifications
 * */

namespace jlma ;

class EventStock
{
    /**
     * @brief ajoute un nouvel évenement
     *
     * @param $type string Type de l'évenement
     * @param $description string Description de l'évenement
     * @param $data string Données de l'évenement
     *
    */
    public function storeEvent( $type, $description , $data )
    {
        $type = DB::table('jla_type_evenement')->where( 'nom_type_even' , trim($type) )->first();


        if( $type !=null ){
            $typeID = $type->id_type_even;
            DB::table('jla_evenement')->insert([
                'desc_even' => $description ,
                'donnees_even' => $data,
                'fk_id_type_even' => $typeID
            ]);
        }
    }

    /**
     * @brief retourne les n derniers évenements
     *
     * @param $nb int nombre d'évenements à renvoyer
     *
     * @return array un tableau contenant les différents évenements
     *
    */
    public function getLastEvents( $nb )
    {
        $events = DB::table('jla_evenement')->orderBy( 'date_even','desc' )->limit($nb)->get();

        return $events;
    }
}