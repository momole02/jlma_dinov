<?php

namespace jlma ;

/** Classe permettant la gestion des droits sur différentes routes*/


class Rights
{
    /* nom de la route => 'groupes utilisateurs pourvant acceder' */
    /* si une route n'est pas spécifiée cela signifie que
            tout le monde peut y accéder
        */


    private static $routes = [
        'adminAcceptRenting' => 'root',/* seul le super utilisateur peut Y accéder */
        'adminRentingCard' => 'root',/* seul le super utilisateur peut Y accéder */
        'adminClients' => 'root',
        'adminSearchClients' => 'root',
        'adminClientCard' => 'root',
        'adminDoDropClient' => 'root',
        'adminDoActivateAccount' => 'root',
        'adminDoZeroPassword' => 'root',
        'adminVehiclesBrands' => 'root',
        'adminTestimonials' => 'root',
        'adminDoDropTestimonials' => 'root',
        'adminFaqs' => 'root',
        'adminDoDropFaq' => 'root' ,
        'adminCustomerService' => 'root',
        'adminDoDropCustomerService' => 'root',
        'adminStats' => 'root',
        'adminDoDropStat' => 'root',

        'adminDoSearchClient' => 'root',
        'adminDoAddVehicleBrand' => 'root',
        'adminDoDropVehicleBrand' => 'root',
        'adminDoAddVehicleType' => 'root',
        'adminDoDropVehicleType' => 'root',
        'adminDoAddTestimonial' => 'root',
        'adminDoDropTestimonial' => 'root',
        'adminDoAddCustomerService' => 'root',
        'adminDoDropCustomerService' => 'root'
        ];

    /* verifie si la route est autorisée pour l'utilisateur actuel */
    public static function routeAuthorizedForCurrentUser( $routeName )
    {
        $accountBusiness = new AccountBusiness();
        if( array_key_exists( $routeName,Rights::$routes ) ){

            $currentAccount =  $accountBusiness->loggedAccountData();
            if(  Rights::$routes[$routeName] == $currentAccount->type_compte )
                return true;
            return false;
        }
        return true;
    }
}