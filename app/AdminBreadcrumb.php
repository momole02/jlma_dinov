<?php
/**
 *
 * AdminBreadcrumb.php
 *
 * Gestion des breadrumbs de la partie admin de JLMA
 */

namespace jlma;


class AdminBreadcrumb extends Breadcrumb
{

    private $myRoutes = [
        'adminDashboard' => ['name' => 'Dashboard', 'level'=>0],
        'adminVehicles' => ['name'=>'Vehicules' , 'level'=>1],
        'adminRentings' => ['name'=>'Reservations' , 'level'=>1],
        'adminClients' => ['name'=>'Clients' , 'level'=>1],
        'adminSearchRentings' => ['name'=>'Rech. reservation' , 'level'=>1],
        'adminSearchClients' => ['name'=>'Rech. clients' , 'level'=>1],
        'adminTestimonials' => ['name'=>'Témoignages' , 'level'=>1],
        'adminVehiclesBrands' => ['name'=>'Marques/Modèles' , 'level'=>1],
        'adminFaqs' => ['name'=>'FAQs' , 'level'=>1],
        'adminCustomerService' => ['name'=>'Service client' , 'level'=>1],
        'adminStats' => ['name'=>'Statistiques' , 'level'=>1],
        'adminLogs' => ['name'=>'Logs' , 'level'=>1],
        'adminEventCard' => ['name'=>'Info evt.' , 'level'=>2],
        'adminNotificationsList' => ['name'=>'Notifications' , 'level'=>10],

        'adminEditVehicle' => ['name'=>'Modifier véhicule' , 'level'=>2],
        'adminVehicleImages' => ['name'=>'Médias véhicule' , 'level'=>4],
        'adminRentingCard' => ['name'=>'Infos reservations' , 'level'=>3],
        'adminClientCard' => ['name'=>'Fiche client' , 'level'=>3],
    ];

    public function __construct()
    {
        parent::__construct( $this->myRoutes , 'jlma-admin-breadcrumb-data' );
    }


}