<?php

/* AdminBusiness.php - Classe de gestion des opération métier coté administration */
namespace jlma;


use Illuminate\Support\Facades\DB;

class AdminBusiness
{

    public function totalCars()
    {
        return DB::table('jla_vehicul')->count();
    }

    public function totalUsers()
    {
        return DB::table('jla_compte')->where('actif',1)->count();
    }

    public function totalReservations()
    {
        return DB::table('jla_location')->count();
    }

    public function totalTestimonials()
    {
        return DB::table('jla_temoignage')->count();
    }


    public function storeRentingSearchData( $search_result )
    {
        session()->flash('jlma-admin-search-rentings-data' , $search_result);
    }


    public function zeroRentingSearchData()
    {
        session()->pull( 'jlma-admin-search-rentings-data' );
    }
    /**
     * @brief donne les menus en fonction du type de l'utilisateur
    */
    public function menus()
    {
        $menus = array();

        /* menu du super utilisateur */
        $menus['root'] = [
            /*  Nom    Lien    Sous menus*/
            ['Vehicules' , route('adminVehicles') , null],
            ['Reservations' , route('adminRentings') , null],
            ['Rech. reservations' , route('adminSearchRentings'), null],
            ['Comptes' , route('adminClients') , null],
            ['Rech. clients ' , route('adminSearchClients') , null],
            ['Modèles/Marques' , route('adminVehiclesBrands'), null],
            ['Suivi' , route('adminLogs'), null],
            ['Contenu' , '#' ,[
                ['Temoignages' , route('adminTestimonials') ],
                ['FAQs' , route('adminFaqs') ],
                ['Service client' , route('adminCustomerService') ],
                ['Statistiques' , route('adminStats')],
                ]
            ]
        ];

        /* menu d'un utilisateur classique */
        $menus['other']=[
            ['Mes vehicules' , route('adminVehicles') , null],
            ['Mes reservations' , route('adminRentings') , null],
        ];

        return $menus;

    }

    /**
     * @brief retourne tout les slugs des admins
     *
     * @return array un tableau avec les slugs de l'admin
    */
    public function getAllAdminSlugs( )
    {
        return DB::table('jla_compte')->where('type_compte' , 'root')
            ->pluck('slug');

    }
}