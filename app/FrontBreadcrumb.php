<?php
/**
 *
 * FontBreadcrumb.php
 *
 * Gestion des breadrumbs de la partie front end de JLMA
 */

namespace jlma;


class FrontBreadcrumb extends  Breadcrumb
{

    private $myRoutes = [
        'home' => ['name' => 'Accueil', 'level'=>0],
        'howitwork' => ['name'=>'CCM' , 'level'=>1],
        'showCars' => ['name'=>'Vehicules' , 'level'=>1],
        'carDetails' => ['name'=>'Info véhicules' , 'level'=>3],
        'login' => ['name'=>'Login' , 'level'=>1],
        'members' => ['name'=>'Espaces membres' , 'level'=>1],
        'editProfile' => ['name'=>'Edition profil' , 'level'=>3],
        'carSearchResults' => ['name'=>'Resultats recherche' , 'level'=>1],
        'signupStep2' => ['name'=>'Etape 2 inscription' , 'level'=>1],
        'signupStep3' => ['name'=>'Etape 2 inscription' , 'level'=>1],
    ];

    public function __construct()
    {
        parent::__construct( $this->myRoutes , 'jlma-front-breadcrumb-data' );
    }
}