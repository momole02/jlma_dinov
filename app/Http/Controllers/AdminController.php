<?php


namespace jlma\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use jlma\AccountBusiness;
use jlma\AdminBreadcrumb;
use jlma\AdminBusiness;
use jlma\CarBusiness;
use jlma\Breadcrumb;
use jlma\EventStock;
use jlma\Front_Utils;


define('NB_ITEMS_PER_PAGE' , '5');

class AdminController extends Controller
{



    /**
     * @brief Donne le menu correct(en fonction du type d'utilisateur)
    */
    private function getTheGoodMenu()
    {

        $adminBusiness = new AdminBusiness();

        $accountBusiness = new AccountBusiness();
        $menus = $adminBusiness->menus();

        $choosedMenu = array() ;
        $account = $accountBusiness->loggedAccountData();
        if( $account->type_compte==='root' ) $choosedMenu = $menus['root'];
        else $choosedMenu = $menus['other'];

        return $choosedMenu;

    }

    /**
     * @brief affiche le dashboard
    */
    public function dashboard( Request $req )
    {
        $adminBusiness = new AdminBusiness();
        $accountBusiness = new AccountBusiness();

        if( $accountBusiness->isClientConnected() ) {

            $choosedMenu = $this->getTheGoodMenu();

            $accountData = $accountBusiness->loggedAccountData() ;

            if( $accountData->type_compte=='root' ){
                return view('admin/dashboard')
                    ->with('total_cars', $adminBusiness->totalCars())
                    ->with('total_users', $adminBusiness->totalUsers())
                    ->with('total_reservations', $adminBusiness->totalReservations())
                    ->with('total_testimonials', $adminBusiness->totalTestimonials())
                    ->with('choosed_menu' , $choosedMenu );
            }else{
                return view('admin/dashboard')
                    ->with('no_content' , true)
                    ->with('choosed_menu' , $choosedMenu );
            }
        }
        else
            return redirect()->route('adminLogin');
    }

    /**
     * @brief affiche le panel de login
    */
    public function login()
    {
        $accountBusiness = new AccountBusiness();

        if( !$accountBusiness->isClientConnected() )
            return view('admin/login');
        else
            return redirect()->route('adminDashboard');

    }

    /**
     * @brief réalise la connexion
    */
    public function doLogin( Request $req )
    {
        $req->validate([
            'client-pseudo'=>'required',
            'client-password' => 'required']
        );

        $accountBusiness = new AccountBusiness();

        if( !$accountBusiness->isClientConnected() ){
            $post = $req->all();
            $pseudo = $post['client-pseudo'];
            $password = $post['client-password'];

           $accountData = $accountBusiness->fetchAccount( $pseudo,$password );
            if( $accountData!=null ){
                $accountBusiness->connectClient( $accountData );

                return redirect()->route('adminDashboard');

            }else{
                return redirect()->route('adminLogin')->with('error_msg' , 'Identifiants inccorects');
            }
        }else{
            return redirect()->route('adminDashboard');
        }
    }

    /**
     * @brief déconnecte l'utilisateur
    */
    public function doLogout()
    {
        $accountBusiness = new AccountBusiness();
        $accountBusiness->logoutClient();
        return redirect()->route('adminLogin');
    }


    /******************************VEHICULES**********************************/
    /**
     * @brief Affiche le panel des vehicules
    */
    public function vehicles(Request $req , $currentPage=0)
    {
        $carBusiness = new CarBusiness();
        $accountBusiness = new AccountBusiness( ) ;
        $currentUserType = $accountBusiness->loggedAccountData()->type_compte;
        $currentUserID = $accountBusiness->loggedAccountData()->id_compte;

        $nbItemsPerPages = NB_ITEMS_PER_PAGE;


        $vehiclesCount=  ( $currentUserType=='root' )
                            ? DB::table('jla_vehicul')->count()
                            : DB::table('jla_vehicul')->where('fk_id_proprietaire',$currentUserID)->count();

        $brandList = $carBusiness->allCarsBrands(); /*recupérer toutes les marques*/
        $modelList = $carBusiness->allCarsModels();
        $energyList = $carBusiness->allEnergies();
        $typesList = $carBusiness->allVehicleTypes();

        $pageList = Front_Utils::getAllPages( $vehiclesCount, 'adminVehicles',  $nbItemsPerPages );
        if( $currentPage>0 && $currentPage<count($pageList) )
            $pageList[$currentPage]['activated']=true;


        $vehicles = ($currentUserType!='root')
                    ? $carBusiness->allCars( $currentPage*$nbItemsPerPages , $nbItemsPerPages , $currentUserID )
                    : $carBusiness->allCars( $currentPage*$nbItemsPerPages , $nbItemsPerPages );

        /**TODO : gérer les droits d'accès*/

        return view('admin/vehicles')
            ->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('page_list' , $pageList )
            ->with('vehicles' , $vehicles)
            ->with('current_page' , $currentPage)
            ->with('total' , $vehiclesCount)
            ->with('_brand_list' , $brandList)
            ->with('_model_list' , $modelList)
            ->with('_types_list' , $typesList)
            ->with('_energy_list' , $energyList);

    }

    /**
     * @brief Vue de modification d'un véhicule
    */
    public function editVehicle(Request $req, $slug )
    {
        $carBusiness = new CarBusiness();
        $accBusiness = new AccountBusiness() ;

        $vehicle = $carBusiness->vehicleBySlug($slug);

        $brandList = $carBusiness->allCarsBrands(); /*recupérer toutes les marques*/
        $modelList = $carBusiness->allCarsModels();
        $energyList = $carBusiness->allEnergies();
        $typesList = $carBusiness->allVehicleTypes();


        if( $accBusiness->loggedAccountData()->type_compte !='root' &&
            $accBusiness->loggedAccountData()->id_compte != $vehicle->fk_id_proprietaire)
        {
            return response(null , 403);
        }

        return view('admin/editVehicle')
            ->with('vehicle' , $vehicle)
            ->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('_brand_list' , $brandList)
            ->with('_model_list' , $modelList)
            ->with('_types_list' , $typesList)
            ->with('_energy_list' , $energyList);


    }

    /*
     * Affiche le panel de gestion des images des vehicules
     * */
    public function vehicleImages( Request $req, $slug)
    {
        $carBusiness = new CarBusiness() ;
        $accBusiness = new AccountBusiness( );

        $picturesList = $carBusiness->vehicleImagesBySlug( $slug );
        $vehicle = $carBusiness->vehicleBySlug( $slug );
        $vehicleDocuments = $carBusiness->allVehicleDocuments( $slug );

        $view = view('admin/vehicleImages')
            ->with('vehicle', $vehicle)
            ->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('pictures_list',$picturesList)
            ->with('car_slug' , $slug)
            ->with('video_link' , $vehicle->lien_video)
            ->with('vehicle_docs' , $vehicleDocuments);


        if( $accBusiness->loggedAccountData()->type_compte !='root' &&
            $accBusiness->loggedAccountData()->id_compte != $vehicle->fk_id_proprietaire){
            $view->with('readonly' , true);
        }
        return $view;
    }

    /*
    * Supprime une image de véhicule
    * */
    public function dropVehicleImage( $id )
    {
        $carBusiness = new CarBusiness();
        $carBusiness->dropVehicleImageByID( $id );

        $adminBreadcrumb = new AdminBreadcrumb();

        return $adminBreadcrumb->redirectLast( route('adminVehicles') );
    }



    /******************************RESERVATIONS**********************************/

    /*
     * Reservations
     */
    public function rentings( Request $req , $page=0 )
    {
        $accBusiness= $accountBusiness = new AccountBusiness( ) ;
        $currentUserType = $accountBusiness->loggedAccountData()->type_compte;
        $currentUserID = $accountBusiness->loggedAccountData()->id_compte;

        $carBusiness = new CarBusiness();

        $nbItemsPerPages=10;
        $rentingsCount = $carBusiness->rentingCount();
        $currentPage=$page;
        $pageList = Front_Utils::getAllPages( $rentingsCount, 'adminRentings',  $nbItemsPerPages );
        if( $currentPage>0 && $currentPage<count($pageList) )
            $pageList[$currentPage]['activated']=true;


        $rentings = ($currentUserType!='root')
                    ? $carBusiness->allRentings( $currentPage*$nbItemsPerPages,$nbItemsPerPages , $currentUserID)
                    :$carBusiness->allRentings( $currentPage*$nbItemsPerPages,$nbItemsPerPages );

        $view = view('admin/rentings')
            ->with( 'current_page', $currentPage)
            ->with( 'page_list',$pageList )
            ->with( 'rentings' , $rentings)
            ->with('choosed_menu', $this->getTheGoodMenu());
        if( $accBusiness->loggedAccountData()->type_compte !='root' )
        {
            $view->with('readonly',true);
        }

        return $view;
    }


    /*
     * Affiche plus d'infos sur la reservation */
    public function rentingCard( $slug )
    {
        $carBusiness = new CarBusiness();
        $renting = $carBusiness->rentingBySlug( $slug );
        return view('admin/rentingCard')
            ->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('renting',$renting);

    }

    /**
     * Recherche des reservations
    */
    public function searchRentings()
    {

        $accBusiness = new AccountBusiness( );

        if( $accBusiness->loggedAccountData()->type_compte !='root' )
        {
            return response(null , 403);
        }
        return view('admin/searchRentings')->with('choosed_menu' , $this->getTheGoodMenu());
    }



    /*****************************CLIENT**********************************/

    public function clients( $page=0 )
    {

        $accBusiness = $accountBusiness = new AccountBusiness();
        $clientCount = $accountBusiness->clientsCount();
        $nbItemsPerPages = 10;
        $pageList = Front_Utils::getAllPages( $clientCount, 'adminClients',  $nbItemsPerPages );
        $clients = $accountBusiness->allClients($page*$nbItemsPerPages , $nbItemsPerPages);

        return view('admin/clients')
            ->with('page_list',$pageList)
            ->with('current_page' , $page)
            ->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('clients',$clients);
    }

    public function searchClients(  )
    {
        $accBusiness = new AccountBusiness( );
        if( $accBusiness->loggedAccountData()->type_compte !='root')
        {
            return response(null , 403);
        }

        return view('admin/searchClients')->with( 'choosed_menu',$this->getTheGoodMenu() );
    }

    public function clientCard( $slug )
    {

        $accountBusiness = new AccountBusiness();
        $carBusiness = new CarBusiness() ;

        $clientData = $accountBusiness->clientData( $slug );
        $vehicles = $carBusiness->vehiclesByAccountID( $clientData->accountData->id_compte );
        $rentings = $carBusiness->rentingsByAccountID( $clientData->accountData->id_compte );

        return view('admin/clientCard')
            ->with('rentings',$rentings)
            ->with('vehicles',$vehicles)
            ->with('client' , $clientData )
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }



    /*
     * Panel des marques */
    public function vehiclesBrands()
    {
        $carBusiness = new CarBusiness() ;

        $brands = $carBusiness->allCarsBrands();
        $models = $carBusiness->allCarsModels();
        $types = $carBusiness->allVehicleTypes();


        return view('admin/brands')->with('types' ,$types)
                ->with('brands' , $brands)
                ->with('models' ,$models)
                ->with('choosed_menu',$this->getTheGoodMenu());
    }



    /**
     * Panel des témoignages
    */
    public function testimonials()
    {

        $testimonials = DB::table('jla_temoignage')->get();

        return view('admin/testimonials')
            ->with('testimonials',$testimonials)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }



    /**
     * Panel des FAQs
    */
    public function faqs(  )
    {
        $faqs = DB::table('jla_faq' )->get();
        return view('admin/faqs')
            ->with('faqs' , $faqs)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }


    /**
     * Panel du service client
    */
    public function customerService()
    {

        $customerServiceMembers = DB::table('jla_service_client')->get();

        return view('admin/customerService')
            ->with('customer_service_members' , $customerServiceMembers )
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }




    public function stats()
    {
        $stats = DB::table('jla_stats')->get();

        return view('admin/stats')
            ->with('stats' , $stats)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }
    
    
    public function logs(  )
    {

        $events = EventStock::getNFirsts( 10 ); /*afficher les 10 derniers évenements*/

        return view('admin/eventList')
            ->with('events' , $events)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }

    ////////////////////////////////////////////////////////////TRAITEMENTS////////////////////////////////////////////////////////////



    /**
     *
     * @brief Ajoute un vehicule vehicule
    */
    public function doAddVehicle( Request $request )
    {
        $post = $request->all();
        $accountBusiness = new AccountBusiness();
        if( $accountBusiness->isClientConnected() ){

            $carBusiness = new CarBusiness();
            $nbItemsPerPages = NB_ITEMS_PER_PAGE;

            $car_registration_number = $post['car-registration-number'];
            $car_color = $post['car-color'];
            $car_year = $post['car-year'];
            $car_description = $post['car-description'];
            $car_doors_count = $post['car-doors-count'];
            $car_places_count = $post['car-places-count'];
            /**TODO : Prendre en compte la saisie manuelle */

            /* l'user à spécifié une autre marque */
            if( isset($post['car-other-brand']) && !empty($post['car-other-brand']) ){
                /* si l'autre marque à été spécifiée on insert et on prend son ID */
                $car_brand_id = $carBusiness->insertBrandAndGetID( $post['car-other-brand'] );

            }else {
                $car_brand_id = $post['car-brand'];
            }

            if( isset($post['car-other-model']) && !empty($post['car-other-model']) ){
                $car_model_id = $carBusiness->insertModelAndGetID( $post['car-other-model'] );
            }else {
                $car_model_id = $post['car-model'];
            }

            if( isset($post['car-other-type']) && !empty($post['car-other-type']) ){
                $car_type_id=$carBusiness->insertTypeAndGetID( $post['car-other-type'] );
            }else{
                $car_type_id = $post['car-type'];
            }


            $car_km = $post['car-km'];
            $car_country = $post['car-country'];
            $car_registration_year = $post['car-registration-year'];
            $car_consumption = $post['car-consumption'];
            $car_energy =   isset( $post['car-other-energy'] ) ? $post['car-other-energy']: $post['car-energy'];
            $car_speed_box = isset( $post['car-other-speed-box'] ) ? $post['car-other-speed-box'] :$post['car-speed-box'] ;
            $car_horses_count = $post['car-horses-count'];
            $car_day_price = $post['car-day-price'];
            $car_month_price = $post['car-month-price'];
            $car_year_price = $post['car-year-price'];

            $carBusiness->addVehicle( $car_registration_number , $car_color , $car_year ,
                $car_description , $car_doors_count , $car_places_count ,
                $car_brand_id , $car_model_id , $car_type_id ,
                $car_km , $car_country , $car_registration_year,
                $car_consumption , $car_energy , $car_speed_box , $car_horses_count ,
                $car_day_price,$car_month_price , $car_year_price);


            $vehiclesCount = $carBusiness->carsCount();

            $pageList = Front_Utils::getAllPages( $vehiclesCount, 'adminVehicles',  $nbItemsPerPages );

            /* aller à la dernière page */
            return redirect()->route('adminVehicles' , ['page' => count($pageList)-1]);


        }


    }

    /**
     * @brief Modifie un véhicule
    */
    public function doEditVehicle( Request $request)
    {

        $post = $request->all();
        $request->validate(['car-slug'=>'required']);

        $carBusiness = new CarBusiness();
        $car_registration_number = $post['car-registration-number'];
        $car_color = $post['car-color'];
        $car_year = $post['car-year'];
        $car_description = $post['car-description'];
        $car_doors_count = $post['car-doors-count'];
        $car_places_count = $post['car-places-count'];
        /**TODO : Prendre en compte la saisie manuelle */

        /* l'user à spécifié une autre marque */
        if( isset($post['car-other-brand']) && !empty($post['car-other-brand']) ){
            /* si l'autre marque à été spécifiée on insert et on prend son ID */
            $car_brand_id = $carBusiness->insertBrandAndGetID( $post['car-other-brand'] );

        }else {
            $car_brand_id = $post['car-brand'];
        }

        if( isset($post['car-other-model']) && !empty($post['car-other-model']) ){
            $car_model_id = $carBusiness->insertModelAndGetID( $post['car-other-model'] );
        }else {
            $car_model_id = $post['car-model'];
        }

        if( isset($post['car-other-type']) && !empty($post['car-other-type']) ){
            $car_type_id=$carBusiness->insertTypeAndGetID( $post['car-other-type'] );
        }else{
            $car_type_id = $post['car-type'];
        }

        $car_km = $post['car-km'];
        $car_country = $post['car-country'];
        $car_registration_year = $post['car-registration-year'];
        $car_consumption = $post['car-consumption'];
        $car_energy =   isset( $post['car-other-energy'] ) ? $post['car-other-energy']: $post['car-energy'];
        $car_speed_box = isset( $post['car-other-speed-box'] ) ? $post['car-other-speed-box'] :$post['car-speed-box'] ;
        $car_horses_count = $post['car-horses-count'];
        $car_day_price = $post['car-day-price'];
        $car_month_price = $post['car-month-price'];
        $car_year_price = $post['car-year-price'];

        $car_slug = $post['car-slug'];
        $carBusiness->editVehicle(
            $car_registration_number , $car_color , $car_year ,
            $car_description , $car_doors_count , $car_places_count ,
            $car_brand_id , $car_model_id , $car_type_id ,
            $car_km , $car_country , $car_registration_year,
            $car_consumption , $car_energy , $car_speed_box , $car_horses_count ,
            $car_day_price,$car_month_price , $car_year_price,$car_slug);


        /* aller à la dernière page visitée*/
        $adminBreadcrumb = new AdminBreadcrumb();

        return $adminBreadcrumb->redirectPrevious( route('adminVehicles') );

    }

    /*
     *  Supprime un vehicule
    */
    public function dropVehicle( $slug )
    {
        $carBusiness = new CarBusiness() ;
        $carBusiness->dropVehicleBySlug( $slug );

        $adminBreadcrumb = new AdminBreadcrumb();
        return $adminBreadcrumb->redirectLast( route('adminVehicles') );
    }

    /*
     * Ajoute une image à un véhicule
    */
    public function doAddVehicleImage( Request $req )
    {

        $carBusiness = new CarBusiness();

        $req->validate(['car-slug'=>'required','picture'=>'required']);
        $post = $req->except(['picture']);

        $path = $req->file('picture')->store('public/vehicle_pictures');


        $carBusiness->addVehicleImage( $post['car-slug'] , $path );

        return redirect()->route('adminVehicleImages' ,['slug'=>$post['car-slug'] ]);

    }

    /*
     * Modifie la vidéo d'un vehicule */
    public function doChangeVehicleVideoLink( Request  $req)
    {
        $accountBusiness = new AccountBusiness();
        if ($accountBusiness->isClientConnected()) {
            $req->validate(['car-slug'=>'required','video-link'=>'required']);
            $carBusiness = new CarBusiness();
            $post=$req->all();

            $carBusiness->changeVehicleVideoLink( $post['car-slug'], $post['video-link'] );

            return redirect()->route('adminVehicleImages',['slug'=>$post['car-slug']]);
        }

        return redirect()->route('adminLogin');
    }

    /*
     * ajoute un document au vehicule
    */
    public function doAddVehicleDocument( Request $req )
    {

        $req->validate(['car-slug'=>'required','doc-title'=>'required','doc-file'=>'required']);

        $post = $req->all();

        $docFilePath = $req->file('doc-file')->store('public/vehicles_documents');
        $docTitle = $post['doc-title'];
        $docDescription = (isset($post['doc-description'])) ? $post['doc-description']:'';
        $carSlug = $post['car-slug'];

        $carBusiness = new CarBusiness();
        $carBusiness->addVehicleDoc( $carSlug , $docTitle , $docFilePath , $docDescription );

        return redirect()->route('adminVehicleImages' , ['slug'=>$carSlug ]);

    }

    /*
     * supprime un document
     *  **/
    public function dropVehicleDocument( $document_slug)
    {
        $carBusiness = new CarBusiness();
        $carBusiness->dropVehicleDocument( $document_slug );

        $adminBreadcrumb = new AdminBreadcrumb();
        return $adminBreadcrumb->redirectLast( route('adminVehicles') );
    }

    public function doAddVehicleBrand( Request $req )
    {
        $req->validate(['brand-name' => 'required']);

        $brandName = $req->post('brand-name');

        $carBusiness = new CarBusiness( );
        $carBusiness->insertBrandAndGetID( $brandName );

        return redirect()->route('adminVehiclesBrands' );

    }



    public function doDropVehicleBrand( Request $req )
    {
        $req->validate(['brands-list'=>'required']);

        $brandIDList = $req->post('brands-list');


        $carBusiness = new CarBusiness( );
        foreach( $brandIDList as $brandID )
            $carBusiness->dropVehicleBrand( $brandID );

        return redirect()->route('adminVehiclesBrands' );
    }

    public function doAddVehicleModel( Request $req )
    {
        $req->validate( ['model-name'=>'required'] );

        $modelName = $req->post('model-name');

        $carBusiness = new CarBusiness();
        $carBusiness->insertModelAndGetID( $modelName );

        return redirect()->route('adminVehiclesBrands');
    }

    public function doDropVehicleModel( Request $req )
    {

        $req->validate(['models-list'=>'required']);

        $modelList = $req->post('models-list');

        $carBusiness = new CarBusiness( );
        foreach( $modelList as $modelID )
            $carBusiness->dropVehicleModel( $modelID );

        return redirect()->route('adminVehiclesBrands' );
    }

    public function doAddVehicleType( Request $req )
    {
        $req->validate( ['type-name'=>'required'] );

        $typeName = $req->post('type-name');

        $carBusiness = new CarBusiness();
        $carBusiness->insertTypeAndGetID( $typeName );

        return redirect()->route('adminVehiclesBrands');
    }

    public function doDropVehicleType( Request $req )
    {

        $req->validate(['types-list'=>'required']);

        $typesIDList = $req->post('types-list');

        $carBusiness = new CarBusiness( );
        foreach( $typesIDList as $typeID )
            $carBusiness->dropVehicleType( $typeID );

        return redirect()->route('adminVehiclesBrands' );
    }




    public function dropRenting( $slug )
    {
        $carBusiness = new CarBusiness() ;
        $carBusiness->dropRenting( $slug );
        return redirect()->route('adminRentings');

    }

    public function acceptRenting( $slug )
    {
        $carBusiness = new CarBusiness();
        $carBusiness->acceptRenting( $slug );
        return redirect()->route('adminRentings');
    }

    /*
     * Recherche une reservation
    */
    public function doSearchRentings( Request $req )
    {
        $req->validate(['renting-accepted' => 'required']);

        $post = $req->all() ;

        $rentingBeginDate = isset($post['renting-begin-date']) ? $post['renting-begin-date'] : null ;
        $rentingBeginTime = isset($post['renting-begin-time']) ? $post['renting-begin-time'] : null ;
        $rentingEndDate = isset($post['renting-end-date']) ? $post['renting-end-date'] : null ;
        $rentingEndTime = isset($post['renting-end-time']) ? $post['renting-end-time'] : null ;
        $rentingAccepted = $post['renting-accepted']=='on' ? true : false;

        $carBusiness = new CarBusiness(  );
        $searchResult = $carBusiness->searchRentings( $rentingBeginDate , $rentingBeginTime ,
            $rentingEndDate , $rentingEndTime,$rentingAccepted );

        $adminBusiness = new AdminBusiness();
        $adminBusiness->storeRentingSearchData( $searchResult );

        $adminBreadcrumbs = new AdminBreadcrumb();
        return $adminBreadcrumbs->redirectLast(route('adminRentings'));
    }

    /*
     * Supprime un client
    */
    public function doDropClient( $slug )
    {
        $accountBusiness = new AccountBusiness();
        $accountBusiness->dropClient( $slug );
        $adminBreadcrumb = new AdminBreadcrumb();
        return $adminBreadcrumb->redirectLast(route('adminClients'));
    }

    /*
     * Recherche un client
    */
    public function doSearchClients( Request $req )
    {
        $post = $req->all();

        $clientFirstName =   isset( $post['client-first-name'] ) ? $post['client-first-name'] : null;
        $clientLastName =   isset( $post['client-last-name'] ) ? $post['client-last-name'] : null ;
        $clientCNI =        isset( $post['client-cni'] ) ? $post['client-cni'] : null ;
        $clientPseudo =     isset( $post['client-pseudo'] ) ? $post['client-pseudo'] : null ;
        $clientLocation =     isset( $post['client-location'] ) ? $post['client-location'] : null ;

        $accountBusiness = new AccountBusiness();
        $clients = $accountBusiness->searchClients( $clientCNI , $clientFirstName , $clientLastName ,$clientLocation, $clientPseudo);

        return view('admin/searchClients')->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('clients' , $clients);

    }

    public function doActivateAccount( $slug, $status )
    {
        $accountBusiness = new AccountBusiness(  );
        $adminBreadcrumb = new AdminBreadcrumb();

        $accountBusiness->activateAcount( $slug , $status );
        return $adminBreadcrumb->redirectLast( route('adminClientCard',['slug'=>$slug]) );

    }

    public function doZeroPassword( $slug )
    {
        $accountBusiness = new AccountBusiness(  );
        $adminBreadcrumb = new AdminBreadcrumb();

        $accountBusiness->zeroPassword( $slug );
        return $adminBreadcrumb->redirectLast( route('adminClientCard',['slug'=>$slug]) );
    }

    public function doAddTestimonial( Request $req )
    {
        $req->validate(['testimonial-photo'=>'required',
            'testimonial-name'=>'required' ,
            'testimonial-job'=>'required',
            'testimonial-content'=>'required']);


        $testimonialPhoto = $req->file('testimonial-photo')->store( 'public/clients_photo' );
        $testimonialName = $req->post('testimonial-name');
        $testimonialJob = $req->post('testimonial-job');
        $testimonialContent = $req->post('testimonial-content');

        DB::table('jla_temoignage')->insert([
            'photo_tem' => Storage::url($testimonialPhoto),
            'nom_tem' => $testimonialName,
            'prof_tem' => $testimonialJob,
            'contenu_tem' => $testimonialContent,
            'slug'=>Front_Utils::makeSlug('testimonial')
        ]);

        return redirect()->route('adminTestimonials');

    }

    public function doDropTestimonial( $slug )
    {
        DB::table('jla_temoignage')->where('slug',$slug)->delete();

        return redirect()->route('adminTestimonials');
    }

    public function doAddFaq( Request $req )
    {
        $req->validate(['faq-question'=>'required','faq-response'=>'required']);

        $faqQuestion = $req->post('faq-question');
        $faqResponse = $req->post('faq-response');

        DB::table('jla_faq')->insert([
            'question_faq' => $faqQuestion,
            'reponse_faq' => $faqResponse,
            'slug' => Front_Utils::makeSlug( 'faq' )
        ]);
        
        return redirect()->route('adminFaqs');
    }

    public function doDropFaq( $slug )
    {
        DB::table('jla_faq')->where('slug' , $slug)->delete();

        return redirect()->route('adminFaqs');
    }


    public function doAddCustomerService( Request $req )
    {
        $req->validate([
            'cs-photo' => 'required',
            'cs-name' => 'required',
            'cs-nickname' => 'required',
            'cs-job' => 'required',
            'cs-tel' => 'required',
            'cs-email' => 'required'
        ]);

        $csPhoto =      Storage::url($req->file('cs-photo')->store('public/customers_photos'));
        $csName =      $req->post('cs-name');
        $csNickname =   $req->post('cs-nickname');
        $csJob =    $req->post('cs-job');
        $csTel =    $req->post('cs-tel');
        $csEmail =  $req->post('cs-email');


        DB::table('jla_service_client')->insert([
            'photo_serv_client' => $csPhoto,
            'nom_serv_client' => $csName,
            'surnom_serv_client' => $csNickname,
            'job_serv_client' => $csJob,
            'tel_serv_client' => $csTel,
            'email_serv_client' => $csEmail,
            'slug' => Front_Utils::makeSlug('customerService')
        ]);

        return redirect()->route('adminCustomerService');
    }

    public function doDropCustomerService( $slug )
    {
        DB::table('jla_service_client')->where('slug',$slug)->delete();

        return redirect()->route('adminCustomerService');
    }

    public function doAddStat( Request $req )
    {
        $req->validate([
            'stat-variable' => 'required',
            'stat-value' => 'required',
            'stat-icon' => 'required'
        ]);

        $statVariable = $req->post('stat-variable');
        $statValue = $req->post('stat-value');
        $statIcon = $req->post('stat-icon');

        DB::table('jla_stats')->insert([
            'variable_stat' => $statVariable,
            'valeur_stat' => $statValue,
            'icone_stat' => $statIcon,
            'slug' => Front_Utils::makeSlug('stat-entry')
        ]);

        return redirect()->route('adminStats');
    }

    public function doDropStat( $slug )
    {
        DB::table('jla_stats')->where('slug' , $slug)->delete();

        return redirect()->route('adminStats');
    }

    public function doSearchEventsBetween( Request $req )
    {
        $req->validate([
            'log-begin-date' =>'required',
            'log-end-date' => 'required'
        ]);

        $logBeginDate = $req->post('log-begin-date');
        $logEndDate = $req->post('log-end-date');

        $events = EventStock::getBetweenDates( $logBeginDate, $logEndDate );

        return view('admin/eventList')->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('events' , $events);

    }


    public function doSearchLastEvents( Request $req )
    {
        $req->validate([
            'log-nb-items' => 'required',
            'log-order' => 'required'
        ]);

        $N = $req->post('log-nb-items');
        $order = $req->post('log-order')==='asc' ? 'asc' : 'desc';


        $events = EventStock::getNFirsts( $N , $order );

        return view('admin/eventList')->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('events' , $events);
    }

}

