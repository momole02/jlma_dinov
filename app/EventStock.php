<?php

/*
 * EventStock.php
 *
 * Gère les évenements et les notifications
 * */

namespace jlma ;

use Illuminate\Support\Facades\DB;

class EventStock
{
    /**
     * @brief ajoute un nouvel évenement
     *
     * @param $type string Type de l'évenement(nom)
     * @param $titre string Titre de l'évenement
     * @param $description string Description de l'évenement
     * @param $data string Description de l'évenement
     * @param $link  string lien de l'objet concerné
     *
    */
    public static function storeEvent( $type, $titre , $description , $data, $link )
    {
        $exists= DB::table('jla_type_evenement')->where( 'code_type_even' , trim($type) )->exists();


        if( $exists){
            DB::table('jla_evenement')->insert([
                'code_even' => $type,
                'titre_even' => $titre,
                'desc_even' => $description ,
                'lien_even' => $link,
                'slug' => Front_Utils::makeSlug( $titre )
            ]);
        }
    }


    /**
     * @brief retourne des évenements dans une plage donnée
     *
     * @param $begin_date string date de début au format ISO
     * @param $end_date string date de fin au format ISO
     *
     * @return array une liste d'évenements
    */
    public static function getBetweenDates( $begin_date , $end_date )
    {
        $events = DB::table('jla_evenement')->whereBetween( 'date_even' , [$begin_date , $end_date] )->where('archive','0')->get();

        return $events ;
    }

    /**
     * @brief affiche les N premiers évenements
     *
     * @param int N
     *
     * @return array la liste d'évenements
    */
    public static function getNFirsts( $N , $order='asc')
    {
        $events = DB::table('jla_evenement')
            ->orderby('date_even',$order)
            ->where('archive','0')->skip(0)->limit($N)->get( );

        return $events;
    }


}