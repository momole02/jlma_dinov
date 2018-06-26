<?php
/**
 * CarController.php - Contrôleur des voitures
 *
 * @author Marc Arnaud A.
 * */

namespace jlma\Http\Controllers;


use jlma\AccountBusiness;
use jlma\CarBusiness;
use jlma\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CarController extends Controller
{
    /**
     * @brief Affiche les voitures
     *
     * @return une vue
     *
     */
    public function showCars($page=0)
    {
            /* recupérer les voitures depuis la base de données */
            $car_business = new CarBusiness();
            $nbCarsPerPage=5;
            $cars = $car_business->allCarsInterval( $page * $nbCarsPerPage , $nbCarsPerPage); /* récupérer toutes les voitures */
            $carsCount = $car_business->carsCount();

            return view('rentit/listCarsPage')
                ->with('cars', $cars)
                ->with('carsCount' , $carsCount)
                ->with('nbCarsPerPage' , $nbCarsPerPage)
                ->with('page' , $page);
    }

    /**
     * @brief Formulaire de recherche avancée d'offres
    */
    public function advCarSearch()
    {
        return view('rentit/advCarSearchPage');
    }
    /**
     * @brief Effectue une nouvelle recherche d'offre
    */
    public function doSearchCars( Request $req )
    {
        $req->validate([
            'leasing-begin-date' => 'required',
            'leasing-begin-time' => 'required',
            'leasing-end-date' => 'required',
            'leasing-end-time' => 'required'
        ]);

        $post = $req->all();
        $car_business = new CarBusiness();
        $car_business->searchCars($post['leasing-begin-date'],$post['leasing-begin-time'] ,
            $post['leasing-end-date'] , $post['leasing-end-time']);

        return redirect()->route('carSearchResults');
    }

    /**
     * @brief affiche les resultats d'une recherche précédemment faite
     */
    public function carSearchResults( $page=0 )
    {
        $nb_per_pages = 5;
        $car_business = new CarBusiness();
        $cars = $car_business->lastCarSearchResults($page , $nb_per_pages);

        return view('rentit/listCarsPage')
            ->with('useSearch' , true)
            ->with('cars', $cars)
            ->with('carsCount' , $car_business->lastCarSearchCount())
            ->with('nbCarsPerPage' , $nb_per_pages)
            ->with('page' , $page);
    }

    /**
     * @brief Affiche les détails une voiture(en fonction du slug)
     *
     * @param slug
     *
     * @return une vue
    */
    public function carDetails($slug)
    {

        $car_business = new CarBusiness();

        /* récupère le vehicule en fonction du slug */
        $vehicle_details = $car_business->vehicleBySlug( $slug );

        if( $vehicle_details != null ) {
            return view('rentit/carDetails2')
                ->with('details', $vehicle_details)
                ->with('slug', $slug);
        }
        return view('rentit/vehicleNotFound');

    }

    /**
     * @brief affiche le formulaire de location de voiture
     */
    public function carLeasing( $carSlug='no-slug' )
    {
        $acc_business = new AccountBusiness();

        if( $acc_business->isClientConnected() ) {
            return view('cars/carLeasing')->with('carSlug', $carSlug);
        }else{
            return redirect()->route('login')->with('data' , [
                'success' => false,
                'result' => 'Inscrivez vous ou connectez vous pour louer'
            ]);
        }
    }

    /**
     * @brief Effecute la requête de location de véhicule
     */
    public function doCarLeasing( Request $request )
    {
        $acc_business = new AccountBusiness();

        if( !$acc_business->isClientConnected() ) {
            return redirect()->route('login')->with('data' , [
                'success' => false,
                'result' => 'Inscrivez vous ou connectez vous pour louer'
            ]);
        }

        $post = $request->except(['_token']);

        $validator= Validator::make($request->all(),[
            'leasing-car-slug' => 'required',
            'leasing-place' =>'required|min:3',
            'leasing-roam-place' => 'required|min:3',
            'leasing-begin-date' => 'required',
            'leasing-begin-time' => 'required',
            'leasing-end-date' => 'required',
            'leasing-end-time' => 'required',
            'leasing-reason' => 'required',
        ]);

        if( $validator->fails() ) {
            return redirect()->route('carDetails', ['slug' => $post['leasing-car-slug']])
                ->with('post_data', $post)
                ->with('errors', $validator->errors());
        }

        $carBusiness = new CarBusiness();
        $logged_account = $acc_business->loggedAccountData();
        $status = $carBusiness->registerLeasing( $post , $logged_account->id_compte );

        if($status['success']==true)
            return redirect()->route('carDetails' , ['slug' => $post['leasing-car-slug']])->with('data' , $status);
        else
            return redirect()->route('carDetails' , ['slug' => $post['leasing-car-slug']])->with('data' , $status)
                ->with('post_data' , $post);
    }

    /**
     * @brief Affiche toutes les demandes de location du client connecté
     */
    public function showLeasings()
    {
        $acc_business = new AccountBusiness();
        $car_business = new CarBusiness();

        if( !$acc_business->isClientConnected() ){ /* si aucun client n'est connecté */
            return redirect()->route('login')->with('data' , [
                'success' => false,
                'result' => 'Connectez vous pour voir vos locations'
            ]);
        }

        /* client connecté */
        $logged_account = $acc_business->loggedAccountData();
        $leasings = $car_business->allClientLeasings( $logged_account->id_compte );

        return view('cars/listLeasings' )->with('leasings' , $leasings);

    }

    /**
     * @brief supprime une location */
    public function dropLeasing( $slug )
    {
        $car_business = new CarBusiness();
        $acc_controller = new AccountBusiness();
        if( !$acc_controller->isClientConnected() ){ /* verifier si un client est connecté par mesure de sécurité */
            return redirect()->route('login')->with('data' , [
                'succes' => false,
                'result' => 'Connectez vous pour effacer une location'
            ]);
        }

        $status = $car_business->dropLeasingBySlug($slug);
        return redirect('members')->with('data' , $status);

    }

    /**
     * @brief retourne les marques des vehicules au formati JSON
     */

    public function json_carbrands(  )
    {
        $business = new CarBusiness();

        $brands = $business->allCarsBrands(); /* récupérer toutes les marques */
        $result = array();

        for($i=0;$i<count($brands);++$i){
            $br['name'] = $brands[$i]->libelle_marque;
            $br['id'] = $brands[$i]->pk_id;
            array_push($result , $br);
        }

        return response()->json($result);
    }

    /**
     * @brief retourne l'intervalle min,max des années
    */
    public function json_yearsminmax()
    {
        $business = new CarBusiness();

        $minmax = $business->yearsMinMax();

        return response()->json($minmax);
    }
    /**
     * @brief retourne l'intervalle min,max des prix
    */
    public function json_priceminmax()
    {
        $business = new CarBusiness();

        $minmax = $business->priceMinMax();

        return response()->json($minmax);
    }

}