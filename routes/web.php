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
   'uses' => 'AdminController@vehicles'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/editVehicle/{slug}',[
   'as' => 'adminEditVehicle',
   'uses' => 'AdminController@editVehicle'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');



Route::get('/admin/dropVehicle/{slug}',[
    'as' => 'adminDropVehicle',
    'uses' => 'AdminController@dropVehicle'
])->middleware('jlma.checkauth');

Route::get('/admin/vehicleImages/{slug}',[
    'as' => 'adminVehicleImages',
    'uses' => 'AdminController@vehicleImages'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/dropVehicleImage/{id}',[
    'as' => 'adminDropVehicleImage',
    'uses' => 'AdminController@dropVehicleImage'
])->middleware('jlma.checkauth');

Route::get('/admin/dropVehicleDocument/{docSlug}',[
    'as' => 'adminDropVehicleDocument',
    'uses' => 'AdminController@dropVehicleDocument'
])->middleware('jlma.checkauth');

Route::get('/admin/rentings',[
    'as' => 'adminRentings',
    'uses' => 'AdminController@rentings'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/dropRenting/{slug}',[
    'as' => 'adminDropRenting',
    'uses' => 'AdminController@dropRenting'
])->middleware('jlma.checkauth');

Route::get('/admin/acceptRenting/{slug}',[
    'as' => 'adminAcceptRenting',
    'uses' => 'AdminController@acceptRenting'
])->middleware('jlma.checkauth');

Route::get('/admin/rentingCard/{slug}',[
    'as' => 'adminRentingCard',
    'uses' => 'AdminController@rentingCard'
])->middleware('jlma.checkauth' , 'jlma.breadcrumb');

Route::get('/admin/searchRentings',[
    'as' => 'adminSearchRentings',
    'uses' => 'AdminController@searchRentings'
])->middleware('jlma.checkauth','jlma.breadcrumb');




Route::get('/admin/clients/{page?}',[
    'as' => 'adminClients',
    'uses' => 'AdminController@clients'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/searchClients',[
    'as' => 'adminSearchClients',
    'uses' => 'AdminController@searchClients'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/clientCard/{slug}',[
    'as' => 'adminClientCard',
    'uses' => 'AdminController@clientCard'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/doDropClient/{slug}',[
    'as' => 'adminDoDropClient',
    'uses' => 'AdminController@doDropClient'
])->middleware('jlma.checkauth');

Route::get('/admin/doActivateAccount/{slug}/{status}',[
    'as' => 'adminDoActivateAccount',
    'uses' => 'AdminController@doActivateAccount'
])->middleware('jlma.checkauth');

Route::get('/admin/doZeroPassword/{slug}',[
    'as' => 'adminDoZeroPassword',
    'uses' => 'AdminController@doZeroPassword'
])->middleware('jlma.checkauth');


Route::get('/admin/vehiclesBrands',[
    'as' => 'adminVehiclesBrands',
    'uses' => 'AdminController@vehiclesBrands'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/testimonials',[
    'as' => 'adminTestimonials',
    'uses' => 'AdminController@testimonials'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/doDropTestimonial/{slug}',[
    'as' => 'adminDoDropTestimonial',
    'uses' => 'AdminController@doDropTestimonial'
])->middleware('jlma.checkauth');


Route::get('/admin/faqs',[
    'as' => 'adminFaqs',
    'uses' => 'AdminController@faqs'
])->middleware('jlma.checkauth','jlma.breadcrumb');

Route::get('/admin/doDropFaq/{slug}',[
    'as' => 'adminDoDropFaq',
    'uses' => 'AdminController@doDropFaq'
])->middleware('jlma.checkauth');


Route::get('/admin/customerService',[
    'as' => 'adminCustomerService',
    'uses' => 'AdminController@customerService'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/doDropCustomerService/{slug}',[
    'as' => 'adminDoDropCustomerService',
    'uses' => 'AdminController@doDropCustomerService'
])->middleware('jlma.checkauth');

Route::get('/admin/stats',[
    'as' => 'adminStats',
    'uses' => 'AdminController@stats'
])->middleware('jlma.checkauth','jlma.breadcrumb');


Route::get('/admin/doDropStat/{slug}',[
    'as' => 'adminDoDropStat',
    'uses' => 'AdminController@doDropStat'
])->middleware('jlma.checkauth');

Route::get('/admin/logs',[
    'as' => 'adminLogs',
    'uses' => 'AdminController@logs'
])->middleware('jlma.checkauth','jlma.breadcrumb');









////////////////ROUTES POST////////////////
///
Route::post('/admin/doLogin',[
    'as' => 'adminDoLogin',
    'uses' => 'AdminController@doLogin'
]);

Route::post('/admin/doAddVehicle',[
   'as' => 'adminDoAddVehicle',
    'uses' => 'AdminController@doAddVehicle'
])->middleware('jlma.checkauth');

Route::post('/admin/doEditVehicle',[
   'as' => 'adminDoEditVehicle',
    'uses' => 'AdminController@doEditVehicle'
])->middleware('jlma.checkauth');


Route::post('/admin/doAddVehicleImage',[
   'as' => 'adminDoAddVehicleImage',
    'uses' => 'AdminController@doAddVehicleImage'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddVehicleDocument',[
   'as' => 'adminDoAddVehicleDocument',
    'uses' => 'AdminController@doAddVehicleDocument'
])->middleware('jlma.checkauth');


Route::post('/admin/doChangeVehicleVideoLink',[
   'as' => 'adminDoChangeVehicleVideoLink',
    'uses' => 'AdminController@doChangeVehicleVideoLink'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchRentings',[
   'as' => 'adminDoSearchRentings',
    'uses' => 'AdminController@doSearchRentings'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchClients',[
   'as' => 'adminDoSearchClients',
    'uses' => 'AdminController@doSearchClients'
])->middleware('jlma.checkauth');



Route::post('/admin/doAddVehicleBrand',[
   'as' => 'adminDoAddVehicleBrand',
    'uses' => 'AdminController@doAddVehicleBrand'
])->middleware('jlma.checkauth');


Route::post('/admin/doDropVehicleBrand',[
   'as' => 'adminDoDropVehicleBrand',
    'uses' => 'AdminController@doDropVehicleBrand'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddVehicleModel',[
   'as' => 'adminDoAddVehicleModel',
    'uses' => 'AdminController@doAddVehicleModel'
])->middleware('jlma.checkauth');

Route::post('/admin/doDropVehicleModel',[
   'as' => 'adminDoDropVehicleModel',
    'uses' => 'AdminController@doDropVehicleModel'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddVehicleType',[
   'as' => 'adminDoAddVehicleType',
    'uses' => 'AdminController@doAddVehicleType'
])->middleware('jlma.checkauth');

Route::post('/admin/doDropVehicleType',[
   'as' => 'adminDoDropVehicleType',
    'uses' => 'AdminController@doDropVehicleType'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddTestimonial',[
   'as' => 'adminDoAddTestimonial',
    'uses' => 'AdminController@doAddTestimonial'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddFaq',[
    'as' => 'adminDoAddFaq',
    'uses' => 'AdminController@doAddFaq'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddCustomerService',[
    'as' => 'adminDoAddCustomerService',
    'uses' => 'AdminController@doAddCustomerService'
])->middleware('jlma.checkauth');

Route::post('/admin/doAddStat',[
    'as' => 'adminDoAddStat',
    'uses' => 'AdminController@doAddStat'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchEventsBetween/',[
    'as' => 'adminDoSearchEventsBetween',
    'uses' => 'AdminController@doSearchEventsBetween'
])->middleware('jlma.checkauth');

Route::post('/admin/doSearchLastEvents/',[
    'as' => 'adminDoSearchLastEvents',
    'uses' => 'AdminController@doSearchLastEvents'
])->middleware('jlma.checkauth');
