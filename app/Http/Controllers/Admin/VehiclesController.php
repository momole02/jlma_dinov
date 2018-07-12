<?php

namespace jlma\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use jlma\AccountBusiness;
use jlma\AdminBreadcrumb;
use jlma\AdminBusiness;
use jlma\CarBusiness;
use jlma\Front_Utils;
use jlma\Http\Controllers\Controller;

class VehiclesController extends Controller
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


    ///////////////////////////////////////////////ECRANS///////////////////////////////////////////////

    /**
     * @brief Affiche le panel des vehicules
     */
    public function vehicles(Request $req , $currentPage=0)
    {
        $carBusiness = new CarBusiness();
        $accountBusiness = new AccountBusiness( ) ;
        $currentUserType = $accountBusiness->loggedAccountData()->type_compte;
        $currentUserID = $accountBusiness->loggedAccountData()->id_compte;

        $nbItemsPerPages = 10;


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

        return view('admin/vehicles/vehicles')
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

        return view('admin/vehicles/editVehicle')
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

        $view = view('admin/vehicles/vehicleImages')
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

    /*
    * Panel des marques */
    public function vehiclesBrands()
    {
        $carBusiness = new CarBusiness() ;

        $brands = $carBusiness->allCarsBrands();
        $models = $carBusiness->allCarsModels();
        $types = $carBusiness->allVehicleTypes();


        return view('admin/vehicles/brands')->with('types' ,$types)
            ->with('brands' , $brands)
            ->with('models' ,$models)
            ->with('choosed_menu',$this->getTheGoodMenu());
    }



    ///////////////////////////////////////////////TRAITEMENTS///////////////////////////////////////////////

    /**
     *
     * @brief Ajoute un vehicule vehicule
     */
    public function doAddVehicle( Request $request )
    {
        $post = $request->all();
        $accountBusiness = new AccountBusiness();

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
        $car_week_price = $post['car-week-price'];
        $car_month_price = $post['car-month-price'];
        $car_year_price = $post['car-year-price'];
        $loggedAccountData = $accountBusiness->loggedAccountData() ;


        $carBusiness->addVehicle( $car_registration_number , $car_color , $car_year ,
            $car_description , $car_doors_count , $car_places_count ,
            $car_brand_id , $car_model_id , $car_type_id ,
            $car_km , $car_country , $car_registration_year,
            $car_consumption , $car_energy , $car_speed_box , $car_horses_count ,
            $car_day_price,$car_week_price,$car_month_price , $car_year_price ,
            $loggedAccountData->id_compte);


        $vehiclesCount = $carBusiness->carsCount();

        $pageList = Front_Utils::getAllPages( $vehiclesCount, 'adminVehicles',  $nbItemsPerPages );

        /* aller à la dernière page */
        return redirect()->route('adminVehicles' , ['page' => count($pageList)-1]);

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
        $car_week_price = $post['car-week-price'];
        $car_month_price = $post['car-month-price'];
        $car_year_price = $post['car-year-price'];

        $car_slug = $post['car-slug'];
        $carBusiness->editVehicle(
            $car_registration_number , $car_color , $car_year ,
            $car_description , $car_doors_count , $car_places_count ,
            $car_brand_id , $car_model_id , $car_type_id ,
            $car_km , $car_country , $car_registration_year,
            $car_consumption , $car_energy , $car_speed_box , $car_horses_count ,
            $car_day_price,$car_week_price,$car_month_price , $car_year_price,$car_slug);


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
     *  Supprime une liste de véhicule
     * */
    public function doDropVehicleList( Request $req )
    {
        $req->validate(['vehicles-slugs'=>'required']);

        $vehicleSlugs = $req->post('vehicles-slugs');
        $carBusiness = new CarBusiness();
        $adminBreadcrumb = new AdminBreadcrumb( );

        foreach( $vehicleSlugs as $slug )
            $carBusiness->dropVehicleBySlug( $slug );

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


}
