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
     * @param $N int N
     * @param $order string 'asc' ou 'desc'
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


    /**
     * @brief Renseigne un évenement, et publie les notifications
     *
     * @param $type string type de l'évenement(voir table 'jla_type_evenement')
     * @param $title string titre de l'évenement
     * @param $desc string description de l'évenement
     * @param $link string lien sur l'objet
     *
    */
    public static function dispatchEvent( $type , $title , $desc , $link )
    {
        $slug =  Front_Utils::makeSlug(substr($title,0,10));

        DB::table('jla_evenement')->insert([
            'code_even' => $type,
            'titre_even' => $title,
            'desc_even' => $desc,
            'lien_even' => $link,
            'slug' => $slug
        ]);

        $notification['slug'] = $slug;
        $notification['link'] = route('adminEventCard',['slug'=>$slug]);
        $notification['title'] = $title;
        $notification['date'] = date('Y-m-d h:i:s');

        /*
         * Envoyer toutes les notifications aux utilisateurs */
        EventStock::dispatchNotifications( $notification ) ;
    }




    private static function dispatchNotifications( $notification )
    {
        $adminBusiness = new AdminBusiness();
        $adminSlugs = $adminBusiness->getAllAdminSlugs();
        foreach( $adminSlugs as $slug ){
            $notificationFile = $slug.'.notifications.json';
            EventStock::appendNotification( $notificationFile , $notification );
        }
    }

    private static function appendNotification( $notificationFile , $notification )
    {
        assert_options(ASSERT_EXCEPTION , 1);
        assert(
            array_key_exists('date',$notification)&&
            array_key_exists('title',$notification)&&
            array_key_exists('link',$notification)&&
            array_key_exists('slug',$notification)
        );

        $notifs=[];
        if( file_exists($notificationFile) ) {
            $fileContents = file_get_contents($notificationFile);
            if ($fileContents !== FALSE && !empty($fileContents)) {
                $notifs = json_decode($fileContents);
            }
        }

        array_push( $notifs , $notification );
        file_put_contents( $notificationFile , json_encode($notifs) );
    }


    /**
     * @brief retourne toutes les notifications
     *
     * @param $user_slug string slug de l'utilisateur
     *
     * @return array la liste des notification
    */
    public static function getUserNofications( $user_slug )
    {
        $notificationFile = $user_slug.'.notifications.json';
        $fileContents = file_get_contents( $notificationFile );
        $notifs=[];
        if( $fileContents!==FALSE && !empty($fileContents)  ){
            $notifs = json_decode($fileContents);
        }
        return $notifs;
    }


    /**
     * @brief supprime une notification
     *
     * @param $user_slug string slug de l'utilisateur
     * @param $event_slug string slug de l'évenement
    */
    public static function dropUserNotification( $user_slug , $event_slug )
    {
        $notifs = EventStock::getUserNofications( $user_slug );

        for( $i=0;$i<count($notifs);++$i ){
            if( $notifs[$i]->slug ===$event_slug  ){
                array_splice( $notifs , $i , 1 );
            }
        }

        file_put_contents($user_slug.'.notifications.json' , json_encode($notifs) );
    }

}