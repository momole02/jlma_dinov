<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/** Route d'accueil */
Route::get('/',[
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]
);

/** Route de la page comment ça marche*/
Route::get('/howitworks',[
        'as' => 'howitworks',
        'uses' => 'HomeController@howitworks'
    ]
);

/** Route du formulaire d'inscription d'un propriétaire*/
Route::get('/createClient' ,[
   'as' => 'createClient',
   'uses' => 'ClientController@createClient'
]);



/** Route de l'affichage des voitures*/
Route::get('/showCars/{page?}' , [
   'as' => 'showCars',
   'uses' => 'CarController@showCars'
]);


/** Route du l'affichage des détails sur une voiture*/
Route::get('/carDetails/{slug}' , [
   'as' => 'carDetails',
   'uses' => 'CarController@carDetails'
]);

/** Route du formulaire de location de voiture*/
Route::get('/carLeasing/{carSlug}' , [
    'as' => 'carLeasing',
    'uses' => 'CarController@carLeasing'
]);

/** Route de la requête de location des voitures */
Route::post('/doCarLeasing' , [
    'as' => 'doCarLeasing',
    'uses' => 'CarController@doCarLeasing'
]);

/** Route du formulaire de login*/
Route::get('/login' , [
    'as' => 'login',
    'uses' => 'ClientController@login'
]);

/** Route de requête de connexion */
Route::post('/doLogin' , [
    'as' => 'doLogin',
    'uses' => 'ClientController@doLogin'
]);
/** Route de l'espace membre*/
Route::get('/members' , [
   'as' => 'members',
   'uses' => 'ClientController@members'
]);

/** Route de deconnexion */
Route::get('/logout' , [
   'as' => 'logout',
   'uses' => 'ClientController@logout'
]);


/** Route de suppression de location */
Route::get('/dropLeasing/{slug}' ,[
    'as' => 'dropLeasing',
    'uses' => 'CarController@dropLeasing'
]);

/** Route d'édition des paramètres du profil */
Route::get('/editProfile' , [
    'as' => 'editProfile',
    'uses' => 'ClientController@editProfile'
]);

/** Route de requête d'édition du profil */
Route::post('/doEditProfile' ,[
    'as' => 'doEditProfile',
    'uses'=> 'ClientController@doEditProfile'
]);

/** Route de requête d'édition du pseudo*/
Route::post('/doEditPseudo',[
   'as' => 'doEditPseudo',
   'uses' => 'ClientController@doEditPseudo'
]);

/** Route de requête d'édition de mot de passe*/
Route::post('/doEditPassword',[
   'as' => 'doEditPassword',
   'uses' => 'ClientController@doEditPassword'
]);

/** Route de requête de changement de photos */
Route::post('/doChangePhoto' , [
    'as' => 'doChangePhoto',
    'uses' => 'ClientController@doChangePhoto'
]);



/** Route de requête de recherche de voitures disponibles*/
Route::post('/doSearchCars' , [
    'as' => 'doSearchCars',
    'uses' => 'CarController@doSearchCars'
]);


/** Route de recherche avancée de vehicules*/
Route::get('/advCarSearch' ,[
   'as' => 'advCarSearch',
   'uses' => 'CarController@advCarSearch'
]);


/** Route d'affichage du resultat de la recherche
*/
Route::get('/carSearchResults/{page?}' , [
    'as' => 'carSearchResults',
    'uses' => 'CarController@carSearchResults'
]);


/** Route du la requête du formulaire d'inscription d'un propriétaire*/
Route::post('/doSignup1' , [
    'as' => 'doSignup1',
    'uses' => 'ClientController@doSignup1'
]);

/**
 * Route du formulaire de soumission du CNI(étape 2 de l'inscription)
*/
Route::get('/signupStep2',[
    'as' => 'signupStep2',
    'uses' => 'ClientController@signupStep2'
]);
/* ... requête de traitement du formulaire de l'étape 2*/
Route::post('/doSignup2',[
    'as' => 'doSignup2',
    'uses' => 'ClientController@doSignup2'
]);

/* ... retour à parti de la seconde étape*/
Route::get('/backFromSignup2',[
    'as' => 'backFromSignup2',
    'uses' => 'ClientController@backFromSignup2'
]);

/**
 * Route du formulaire de soumission du permis(étape 3 de l'inscription)
*/
Route::get('/signupStep3',[
    'as' => 'signupStep3',
    'uses' => 'ClientController@signupStep3'
]);

/*... requête de traitement du formulaire de l'étape 3*/
Route::post('/doSignup3',[
    'as' => 'doSignup3',
    'uses' => 'ClientController@doSignup3'
]);

/*... retour à partir de l'étape 3*/
Route::get('/backFromSignup3',[
    'as' => 'backFromSignup3',
    'uses' => 'ClientController@backFromSignup3'
]);


/* ...JSON min,max des années des vehicules*/
Route::get('/json_yearsminmax',[
    'as' => 'json_yearsminmax',
    'uses' => 'CarController@json_yearsminmax'
]);

/* ...JSON min,max des prix des vehicules*/
Route::get('/json_priceminmax',[
    'as' => 'json_priceminmax',
    'uses' => 'CarController@json_priceminmax'
]);


////////////////////////////////////////////////////ROUTES ADMIN////////////////////////////////////////////////////////

Route::get('/admin/dashboard' , [
    'as' => 'adminDashboard',
    'uses' => 'AdminController@dashboard'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/login' , [
    'as' => 'adminLogin',
    'uses' => 'AdminController@login'
]);

Route::get('/admin/doLogout',[
   'as' => 'adminDoLogout',
   'uses' => 'AdminController@doLogout'
]);

Route::get('/admin/vehicles/{page?}',[
   'as' => 'adminVehicles',
   'uses' => 'Admin\VehiclesController@vehicles'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/editVehicle/{slug}',[
   'as' => 'adminEditVehicle',
   'uses' => 'Admin\VehiclesController@editVehicle'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');


Route::get('/admin/dropVehicle/{slug}',[
    'as' => 'adminDropVehicle',
    'uses' => 'Admin\VehiclesController@dropVehicle'
])->middleware('jlma.checkauth');

Route::get('/admin/vehicleImages/{slug}',[
    'as' => 'adminVehicleImages',
    'uses' => 'Admin\VehiclesController@vehicleImages'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/dropVehicleImage/{id}',[
    'as' => 'adminDropVehicleImage',
    'uses' => 'Admin\VehiclesController@dropVehicleImage'
])->middleware('jlma.checkauth');

Route::get('/admin/dropVehicleDocument/{docSlug}',[
    'as' => 'adminDropVehicleDocument',
    'uses' => 'Admin\VehiclesController\@dropVehicleDocument'
])->middleware('jlma.checkauth');

Route::get('/admin/rentings',[
    'as' => 'adminRentings',
    'uses' => 'Admin\RentingsController@rentings'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/dropRenting/{slug}',[
    'as' => 'adminDropRenting',
    'uses' => 'Admin\RentingsController@dropRenting'
])->middleware('jlma.checkauth');

Route::get('/admin/acceptRenting/{slug}',[
    'as' => 'adminAcceptRenting',
    'uses' => 'Admin\RentingsController@acceptRenting'
])->middleware('jlma.checkauth');

Route::get('/admin/rentingCard/{slug}',[
    'as' => 'adminRentingCard',
    'uses' => 'Admin\RentingsController@rentingCard'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/searchRentings',[
    'as' => 'adminSearchRentings',
    'uses' => 'Admin\RentingsController@searchRentings'
])->middleware('jlma.checkauth','jlma.breadcrumb');




Route::get('/admin/clients/{page?}',[
    'as' => 'adminClients',
    'uses' => 'Admin\ClientsController@clients'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/searchClients',[
    'as' => 'adminSearchClients',
    'uses' => 'Admin\ClientsController@searchClients'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/clientCard/{slug}',[
    'as' => 'adminClientCard',
    'uses' => 'Admin\ClientsController@clientCard'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/doDropClient/{slug}',[
    'as' => 'adminDoDropClient',
    'uses' => 'Admin\ClientsController@doDropClient'
])->middleware('jlma.checkauth');

Route::get('/admin/doActivateAccount/{slug}/{status}',[
    'as' => 'adminDoActivateAccount',
    'uses' => 'Admin\ClientsController@doActivateAccount'
])->middleware('jlma.checkauth');

Route::get('/admin/doZeroPassword/{slug}',[
    'as' => 'adminDoZeroPassword',
    'uses' => 'Admin\ClientsController@doZeroPassword'
])->middleware('jlma.checkauth');


Route::get('/admin/vehiclesBrands',[
    'as' => 'adminVehiclesBrands',
    'uses' => 'Admin\VehiclesController@vehiclesBrands'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/testimonials',[
    'as' => 'adminTestimonials',
    'uses' => 'Admin\ContentController@testimonials'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/doDropTestimonial/{slug}',[
    'as' => 'adminDoDropTestimonial',
    'uses' => 'Admin\ContentController@doDropTestimonial'
])->middleware('jlma.checkauth');


Route::get('/admin/faqs',[
    'as' => 'adminFaqs',
    'uses' => 'Admin\ContentController@faqs'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/doDropFaq/{slug}',[
    'as' => 'adminDoDropFaq',
    'uses' => 'Admin\ContentController@doDropFaq'
])->middleware('jlma.checkauth');


Route::get('/admin/customerService',[
    'as' => 'adminCustomerService',
    'uses' => 'Admin\ContentController@customerService'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/doDropCustomerService/{slug}',[
    'as' => 'adminDoDropCustomerService',
    'uses' => 'Admin\ContentController@doDropCustomerService'
])->middleware('jlma.checkauth');

Route::get('/admin/stats',[
    'as' => 'adminStats',
    'uses' => 'Admin\ContentController@stats'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/doDropStat/{slug}',[
    'as' => 'adminDoDropStat',
    'uses' => 'Admin\ContentController@doDropStat'
])->middleware('jlma.checkauth');

Route::get('/admin/logs',[
    'as' => 'adminLogs',
    'uses' => 'Admin\EventController@logs'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/doArchiveEvent/{slug}',[
    'as' => 'adminDoArchiveEvent',
    'uses' => 'Admin\EventController@doArchiveEvent'
])->middleware('jlma.checkauth');


Route::get('/admin/eventCard/{slug}',[
    'as' => 'adminEventCard',
    'uses' => 'Admin\EventController@eventCard'
])->middleware('jlma.checkauth','jlma.breadcrumb');




Route::get('/admin/usernotifs',[
    'as' => 'adminUserNotifs',
    'uses' => 'Admin\EventController@userNotifs'
]);

Route::get('/admin/notificationsList',[
    'as' => 'adminNotificationsList',
    'uses' => 'Admin\EventController@notificationsList'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');








////////////////ROUTES POST////////////////
///
Route::post('/admin/doLogin',[
    'as' => 'adminDoLogin',
    'uses' => 'AdminController@doLogin'
]);

Route::post('/admin/doAddVehicle',[
   'as' => 'adminDoAddVehicle',
    'uses' => 'Admin\VehiclesController@doAddVehicle'
])->middleware('jlma.checkauth');

Route::post('/admin/doEditVehicle',[
   'as' => 'adminDoEditVehicle',
    'uses' => 'Admin\VehiclesController@doEditVehicle'
])->middleware('jlma.checkauth');


Route::post('/admin/doDropVehicleList',[
    'as' => 'adminDoDropVehicleList',
    'uses' => 'Admin\VehiclesController@doDropVehicleList'
])->middleware('jlma.checkauth' );


Route::post('/admin/doAddVehicleImage',[
   'as' => 'adminDoAddVehicleImage',
    'uses' => 'Admin\VehiclesController@doAddVehicleImage'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddVehicleDocument',[
   'as' => 'adminDoAddVehicleDocument',
    'uses' => 'Admin\VehiclesController@doAddVehicleDocument'
])->middleware('jlma.checkauth');


Route::post('/admin/doChangeVehicleVideoLink',[
   'as' => 'adminDoChangeVehicleVideoLink',
    'uses' => 'Admin\VehiclesController@doChangeVehicleVideoLink'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchRentings',[
   'as' => 'adminDoSearchRentings',
    'uses' => 'Admin\RentingsController@doSearchRentings'
])->middleware('jlma.checkauth');

Route::post('/admin/doDropRentingList',[
   'as' => 'adminDoDropRentingList',
    'uses' => 'Admin\RentingsController@doDropRentingList'
])->middleware('jlma.checkauth');



Route::post('/admin/doSearchClients',[
   'as' => 'adminDoSearchClients',
    'uses' => 'Admin\ClientsController@doSearchClients'
])->middleware('jlma.checkauth');



Route::post('/admin/doDropClientList',[
   'as' => 'adminDoDropClientList',
    'uses' => 'Admin\ClientsController@doDropClientList'
])->middleware('jlma.checkauth');



Route::post('/admin/doAddVehicleBrand',[
   'as' => 'adminDoAddVehicleBrand',
    'uses' => 'Admin\VehiclesController@doAddVehicleBrand'
])->middleware('jlma.checkauth');


Route::post('/admin/doDropVehicleBrand',[
   'as' => 'adminDoDropVehicleBrand',
    'uses' => 'Admin\VehiclesController@doDropVehicleBrand'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddVehicleModel',[
   'as' => 'adminDoAddVehicleModel',
    'uses' => 'Admin\VehiclesController@doAddVehicleModel'
])->middleware('jlma.checkauth');

Route::post('/admin/doDropVehicleModel',[
   'as' => 'adminDoDropVehicleModel',
    'uses' => 'Admin\VehiclesController@doDropVehicleModel'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddVehicleType',[
   'as' => 'adminDoAddVehicleType',
    'uses' => 'Admin\VehiclesController@doAddVehicleType'
])->middleware('jlma.checkauth');

Route::post('/admin/doDropVehicleType',[
   'as' => 'adminDoDropVehicleType',
    'uses' => 'Admin\VehiclesController@doDropVehicleType'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddTestimonial',[
   'as' => 'adminDoAddTestimonial',
    'uses' => 'Admin\ContentController@doAddTestimonial'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddFaq',[
    'as' => 'adminDoAddFaq',
    'uses' => 'Admin\ContentController@doAddFaq'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddCustomerService',[
    'as' => 'adminDoAddCustomerService',
    'uses' => 'Admin\ContentController@doAddCustomerService'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddStat',[
    'as' => 'adminDoAddStat',
    'uses' => 'Admin\ContentController@doAddStat'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchEventsBetween/',[
    'as' => 'adminDoSearchEventsBetween',
    'uses' => 'Admin\EventController@doSearchEventsBetween'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchLastEvents/',[
    'as' => 'adminDoSearchLastEvents',
    'uses' => 'Admin\EventController@doSearchLastEvents'
])->middleware('jlma.checkauth');

Route::post('/admin/doArchiveEventList',[
    'as' => 'adminDoArchiveEventList',
    'uses' => 'Admin\EventController@doArchiveEventList'
])->middleware('jlma.checkauth');

