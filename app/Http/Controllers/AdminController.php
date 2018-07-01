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


define('NB_ITEMS_PER_PAGE' , '10');

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
                return view('admin/main/dashboard')
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
            return view('admin/main/login');
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
                if( $accountData->actif!=1 ){
                    return redirect()->route('adminLogin')->with('error_msg' , "Votre compte est inactif pour l'instant");
                }
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





    ////////////////////////////////////////////////////////////TRAITEMENTS////////////////////////////////////////////////////////////



}

