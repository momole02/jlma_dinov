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
use jlma\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * @brief Affiche la page d'accueil
     */
    public function index()
    {
        $car_business = new CarBusiness();

        return view('rentit/home')->with('home',true)->with('cars' , $car_business->allCars());
    }

    public function howitworks()
    {
        return view('rentit/howitworks');
    }
}