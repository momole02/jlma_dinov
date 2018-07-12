<?php

namespace jlma\Http\Controllers\Admin;

use Illuminate\Http\Request;
use jlma\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use jlma\AccountBusiness;
use jlma\AdminBreadcrumb;
use jlma\AdminBusiness;
use jlma\EventStock;



class EventController extends Controller
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

    public function logs(  )
    {

        $events = EventStock::getNFirsts( 10 ); /*afficher les 10 derniers évenements*/

        return view('admin/events/eventList')
            ->with('events' , $events)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }

    public function eventCard( $slug )
    {
        $event=DB::table('jla_evenement')->where('slug',$slug);

        if( $event!=null ) {
            $accountBusiness = new AccountBusiness();
            $accountData = $accountBusiness->loggedAccountData();

            /* effacer la notification liée  */
            EventStock::dropUserNotification( $accountData->slug , $slug );

            if ($event->exists()) {
                return view('admin/events/eventCard')
                    ->with('event', $event->first())
                    ->with('choosed_menu', $this->getTheGoodMenu());
            }
        }

        return response(null , 404);
    }

    public function usernotifs(  )
    {
        $accountBusiness = new AccountBusiness();
        if( $accountBusiness->isClientConnected() ){
            $accData = $accountBusiness->loggedAccountData() ;
            return response()->json( EventStock::getUserNofications( $accData->slug ) );
        }
        return response()->json([]);
    }

    public function notificationsList()
    {
        $accountBusiness = new AccountBusiness( );

        $accountData = $accountBusiness->loggedAccountData() ;

        $notifs =  EventStock::getUserNofications( $accountData->slug );

        return view('admin/events/notifications')
            ->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('notifs' , $notifs);
    }

    ///////////////////////////////////////////////TRAITEMENTS///////////////////////////////////////////////


    public function doSearchEventsBetween( Request $req )
    {
        $req->validate([
            'log-begin-date' =>'required',
            'log-end-date' => 'required'
        ]);

        $logBeginDate = $req->post('log-begin-date');
        $logEndDate = $req->post('log-end-date');

        $events = EventStock::getBetweenDates( $logBeginDate, $logEndDate );

        return view('admin/events/eventList')->with('choosed_menu' , $this->getTheGoodMenu())
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

        return view('admin/events/eventList')->with('choosed_menu' , $this->getTheGoodMenu())
            ->with('events' , $events);
    }

    public function doArchiveEvent( $slug )
    {
        $targetEvent = DB::table('jla_evenement' )->where( 'slug' ,$slug );

        if( $targetEvent->exists() ){
            $targetEvent->update(['archive' => 1]);
        }

        $adminBreadcrumb = new AdminBreadcrumb() ;

        return $adminBreadcrumb->redirectLast( session()->previousUrl() );
    }

    public function doArchiveEventList( Request $req )
    {
        $req->validate( ['events-slugs'=>'required']  );

        $eventsSlugs = $req->post('events-slugs');

        $adminBreadcrumb = new AdminBreadcrumb( );

        foreach( $eventsSlugs as $slug ){
            $this->doArchiveEvent( $slug );
        }

        return $adminBreadcrumb->redirectLast( route('adminLogs') );
    }

}
