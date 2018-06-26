<?php

/**
 *  Front_Utils.php - Classe des fonctions utilitaires utilisées sur le front end
 *
 *
*/

namespace jlma;


use Illuminate\Support\Str;

class Front_Utils
{
    /**
     * @brief Donne la date au format 'Mercredi 2 Mai 2018'
     *
     * @param $isoDate date au format ISO
     * @param $show_day Faut-il afficher le jour de la semaine ?
     * @param $show_time Faut-il afficher l'heure ?
     *
     *
     * @return le format
    */
    public static function formatDate($isoDate , $show_day =true, $show_time=true)
    {
        $days=[ 'Dimanche','Lundi' ,'Mardi' ,'Mercredi','Jeudi' , 'Vendredi' , 'Samedi'];
        $months=['Janvier' , 'Fevrier' , 'Mars' , 'Avril' ,
            'Mai' , 'Juin' , 'Juillet' , 'Aout' , 'Septembre' , 'Octobre' , 'Novembre' , 'Decemenbre'];

        $timestamp = strtotime($isoDate);
        if($timestamp == FALSE) /*verifier si le timestamp est valide*/
            return 'Format invalide';


        $dateInfo = getdate($timestamp); /* extraire les informations sur la date donnée */

        $hh = ($dateInfo['hours']>9) ? $dateInfo['hours'] : '0'.$dateInfo['hours'];
        $mm = ($dateInfo['minutes']>9) ? $dateInfo['minutes'] : '0'.$dateInfo['minutes'];
        $wday = (($show_day==true) ? $days[$dateInfo['wday']] : 'Le');
        $time=  (($show_time==true) ? ' à '.$hh.':'.$mm : ' ');

        $fmtDate =  $wday.' '.
                    $dateInfo['mday'].' '.
                    $months[$dateInfo['mon']-1].' '.
                    $dateInfo['year'].$time;

        return $fmtDate;
    }


    /**
     * @brief Donne le prix de la location
     *
     * @param iso_date1 date de debut de la location
     * @param iso_date2 date de fin de la location
     * @param d_price prix du jour
     * @param m_price prix du mois
     * @param y_price prix de l'année
     *
     * @return le prix de la location
    */
    public static function rentingPrice( $iso_date1 , $iso_date2 , $d_price , $m_price , $y_price )
    {
        $t1 = strtotime($iso_date1);
        $t2 = strtotime($iso_date2);

        $dt = $t2-$t1; /* le nombre de secondes entre les deux dates*/

        $day = 24 * 3600; /*un jour vaut combien de secondes ?? */
        $month = 30 * $day; /*un mois ''  */
        $year = 12 * $month;/* un an '' */

        $nb_days = floor($dt/$day); /*le nombre de jours entre les deux dates*/
        $nb_months = floor($dt/$month); /* le nombre de mois(approximatif) ''  */
        $nb_years = floor($dt/$year);  /* le nombre d'années(approximatif) '' */


        $renting_price = 0 ;

        if( $y_price>0 && $nb_years>0 )         $renting_price=$y_price*$nb_years;
        elseif( $m_price>0 && $nb_months>0 )    $renting_price=$m_price*$nb_months;
        elseif( $d_price>0 && $nb_days>0 )      $renting_price=$d_price*$nb_days;

        $renting_price = (int)round($renting_price); /*prendre l'arrondi(au cas ou il s'agit d'un flottant) */

        /* arrondir au bon multiple de 5 (CFA) */
        $mod = $renting_price%5;
        if( $mod > 2) $renting_price = $renting_price-$mod+5;
        else $renting_price = $renting_price-$mod;

        return $renting_price;
    }

    /**
     * @brief Donnee toutes les pages diponibles avec leurs liens
     *
     * @param count nombre total d'éléments
     * @param route_name nom de la route d'affichage
     * @param nb_item_per_page nombre d'éléments par pages

    */
    public static function getAllPages( $count , $route_name, $nb_items_per_page)
    {
        $nbPages = (int)(ceil((float)($count/$nb_items_per_page)));
        $pages = [];
        for($i=0;$i<$nbPages;++$i){
            $pages[]=[
                'num'=>($i+1) ,
                'link'=>route($route_name , ['page'=>$i]),
                'activated'=>false];
        }

        return $pages;
    }

    /**
     * @brief Génère un slug à partir d'une chaine de caractère
     *
     * @param str chaine de caractère de base
    */
    public static function makeSlug( $str )
    {
        $now = new \DateTime(null);

        return Str::slug( $str.' '.$now->format('dmYhis') );
    }



}