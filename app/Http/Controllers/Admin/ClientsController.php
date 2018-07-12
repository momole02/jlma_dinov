<?php

namespace jlma\Http\Controllers\Admin;

use Illuminate\Http\Request;
use jlma\AccountBusiness;
use jlma\AdminBreadcrumb;
use jlma\AdminBusiness;
use jlma\CarBusiness;
use jlma\Front_Utils;
use jlma\Http\Controllers\Controller;

class ClientsController extends Controller
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

    public function clients( $page=0 )
    {

        $accBusiness = $accountBusiness = new AccountBusiness();
        $clientCount = $accountBusiness->clientsCount();
        $nbItemsPerPages = 10;
        $pageList = Front_Utils::getAllPages( $clientCount, 'adminClients',  $nbItemsPerPages );
        $clients = $accountBusiness->allClients($page*$nbItemsPerPages , $nbItemsPerPages);

        return view('admin/clients/clients')
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

        return view('admin/clients/searchClients')->with( 'choosed_menu',$this->getTheGoodMenu() );
    }

    public function clientCard( $slug )
    {

        $accountBusiness = new AccountBusiness();
        $carBusiness = new CarBusiness() ;

        $clientData = $accountBusiness->clientData( $slug );

        if( $clientData!=null ) {
            $vehicles = $carBusiness->vehiclesByAccountID($clientData->accountData->id_compte);
            $rentings = $carBusiness->rentingsByAccountID($clientData->accountData->id_compte);

            return view('admin/clients/clientCard')
                ->with('rentings', $rentings)
                ->with('vehicles', $vehicles)
                ->with('client', $clientData)
                ->with('choosed_menu', $this->getTheGoodMenu());
        }else{
            return view('admin/clientCard')->with('choosed_menu', $this->getTheGoodMenu());
        }
    }


    ///////////////////////////////////////////////TRAITEMENTS///////////////////////////////////////////////

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
     * Supprime une liste de clients
    */
    public function doDropClientList( Request $req )
    {
        $req->validate(['clients-slugs' => 'required']);

        $clientsSlugs = $req->post('clients-slugs');
        $accountBusiness = new AccountBusiness( );
        $adminBreadcrumb = new AdminBreadcrumb( );

        foreach( $clientsSlugs as $slug ){
            $accountBusiness->dropClient( $slug );
        }
        return $adminBreadcrumb->redirectLast( route('adminClients') );
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

        return view('admin/clients/searchClients')->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('clients' , $clients);

    }

    public function doActivateAccount( $slug, $status )
    {
        $accountBusiness = new AccountBusiness(  );
        $adminBreadcrumb = new AdminBreadcrumb();

        $accountBusiness->activateAcount( $slug , $status );
        if( $status==1 )
            $accountBusiness->sendValidationEmail( $slug ); /* envoyer l'email de validation */

        return $adminBreadcrumb->redirectLast( route('adminClientCard',['slug'=>$slug]) );

    }

    public function doZeroPassword( $slug )
    {
        $accountBusiness = new AccountBusiness(  );
        $adminBreadcrumb = new AdminBreadcrumb();

        $accountBusiness->zeroPassword( $slug );
        return $adminBreadcrumb->redirectLast( route('adminClientCard',['slug'=>$slug]) );
    }



}
