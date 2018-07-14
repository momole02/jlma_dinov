<?php
/**
 * HomeController.php - Contrôleur de l'accueil
 *
 * @author Marc Arnaud A.
 *
 * */

namespace jlma\Http\Controllers;

use jlma\AccountBusiness;
use jlma\CarBusiness;
use Illuminate\Support\Facades\DB;
use jlma\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * @brief Affiche la page d'accueil
     */
    public function index()
    {
        $car_business = new CarBusiness();

        $testimonials = DB::table('jla_temoignage')->limit(6)->get( );
        $stats = DB::table('jla_stats')->limit(4)->get();
        $faqs = DB::table('jla_faq')->limit(6)->get();
        $customer_services = DB::table('jla_service_client')->limit(4)->get() ;

        return view('rentit/home')
            ->with('testimonials' , $testimonials)
            ->with('faqs' , $faqs)
            ->with('stats' , $stats)
            ->with('customer_services' , $customer_services)
            ->with('home',true)
            ->with('cars_by_categories' , $car_business->allCarsByCategories(5))
            ->with('cars' , $car_business->allCars());
    }

    public function howitworks()
    {
        return view('rentit/howitworks');
    }
}