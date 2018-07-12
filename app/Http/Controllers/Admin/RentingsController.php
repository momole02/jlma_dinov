<?php

namespace jlma\Http\Controllers\Admin;

use Illuminate\Http\Request;
use jlma\AccountBusiness;
use jlma\AdminBreadcrumb;
use jlma\AdminBusiness;
use jlma\CarBusiness;
use jlma\Front_Utils;
use jlma\Http\Controllers\Controller;


class RentingsController extends Controller
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

        $view = view('admin/rentings/rentings')
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
        return view('admin/rentings/rentingCard')
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
        return view('admin/rentings/searchRentings')->with('choosed_menu' , $this->getTheGoodMenu());
    }

    ///////////////////////////////////////////////TRAITEMENTS///////////////////////////////////////////////


    public function dropRenting( $slug )
    {
        $carBusiness = new CarBusiness() ;
        $carBusiness->dropRenting( $slug );
        return redirect()->route('adminRentings');

    }

    public function doDropRentingList( Request $req )
    {
        $req->validate(['rentings-slugs' => 'required']);

        $carBusiness = new CarBusiness( ) ;
        $rentingsSlug = $req->post('rentings-slugs');

        $adminBreadcrumbs = new AdminBreadcrumb( );

        foreach( $rentingsSlug as $slug )
            $carBusiness->dropRenting( $slug );

        return $adminBreadcrumbs->redirectLast( route('adminRentings') );
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


}
