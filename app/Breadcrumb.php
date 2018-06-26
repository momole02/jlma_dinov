<?php

namespace jlma;

class Breadcrumb
{

    private $routes = [
        'adminDashboard' => ['name' => 'Dashboard', 'level'=>0],
        'adminVehicles' => ['name'=>'Vehicules' , 'level'=>1],
        'adminRentings' => ['name'=>'Reservations' , 'level'=>1],
        'adminEditVehicle' => ['name'=>'Modifier véhicule' , 'level'=>2],
        'adminVehicleImages' => ['name'=>'Médias véhicule' , 'level'=>2],
        'adminRentingCard' => ['name'=>'Infos reservations' , 'level'=>3],
    ];
    
    
    private $sessionVar = 'my-breadcrumb' ;

    /**
     * @brief Constructeur
     *
     * @param $session_var variable de session utilisée pour stocker l'historique
     * @param $routes_list tableau associatif au format
     *  [
     *      <nom_route> => ['name' => <intitulé> , 'level'=><niveau>]
     *  ]
    */
    public function __construct($routes, $session_var )
    {
        $this->routes=$routes;
        $this->sessionVar = $session_var;
    }

    /**
     * @brief Insert une page dans l'historique
     *
     * @param $session_var variable de session contenant le tableau des historiques
     * @param $url url
     * @param $name nom de la page
     * @param $current_index index actuel (ou il faut essayer d'insérer)
     * @param $level niveau de la page
    */

    private function insertHistoryPage_Real( $url , $name , $current_index , $level)
    {
        $session_var = $this->sessionVar;
        //session()->pull($session_var);
        $historyData = ['url' => $url, 'name' => $name, 'level' => $level];



        if ( session()->has($session_var)) {

            $history = session()->get($session_var);


            if (empty($history) ) {/*si l'historique est vide on ajoute*/
                $history[] = $historyData;
                session()->put( $session_var , $history );

            }else {

                $historyCount = count($history);


                /* clipping sur le bon interval */
                if ( $current_index > $historyCount - 1) $current_index = $historyCount - 1;
                if ( $current_index < 0 ) $current_index=0 ;

                if ($current_index == $historyCount - 1 && $history[$current_index]['level'] < $level) {

                    array_push($history, $historyData);
                    session()->put($session_var, $history);

                } else if ($current_index == 0 && $history[$current_index]['level'] >= $level) {

                    $history = [ $historyData ];
                    session()->put($session_var, $history);


                } else if ($history[$current_index]['level'] < $level) {

                    array_splice($history, $current_index); /* supprimer la partie [$current_index , ... , count($history)-1] */
                    array_push($history, $historyData);
                    session()->put($session_var, $history);

                }else if( $history[$current_index]['level'] == $level ){

                    $history[ $current_index ] = $historyData;
                    array_splice($history, $current_index+1); /* supprimer la partie [$current_index , ... , count($history)-1] */
                    session()->put($session_var, $history);

                }
                else {
                    Breadcrumb::insertHistoryPage_Real( $url, $name, $current_index - 1, $level);
                }
            }
        }else{
            session()->put($session_var , [ $historyData ]);
        }
    }



    /**
     * @brief  insert une page dans l'historique
     *
     *
     * @param $route nom de la route
     * @param $url url de la route
     * */
    public function insertHistoryPage( $route , $url )
    {
        $sessionVar = $this->sessionVar;

        if( array_key_exists($route , $this->routes )  ){

            list( $level,$name ) = [$this->routes[$route]['level'] ,$this->routes[$route]['name'] ];
        }else{
            list( $level,$name )= [0,''];
        }

        if( !session()->has( $sessionVar ) )  session()->put( $sessionVar , [] );
        $historyCount = count(session()->get( $sessionVar ));
        $this->insertHistoryPage_Real( $url ,$name, $historyCount-1 , $level );
    }



    public function redirectPrevious( $default_url )
    {
       return redirect( $this->previousPage($default_url) );
    }

    public function redirectLast( $default_url )
    {
        return redirect( $this->lastVisitedPage($default_url) );
    }

    /**
     * @brief retourne tout l'historique coté admin
     */
    public function allHistory(  )
    {
        $sessionVar = $this->sessionVar;
        if( session()->has( $sessionVar ) )
            return session()->get( $sessionVar );
        return null ;
    }

    /**
     * @brief retuourne la dernière page visitée
    */
    public function lastVisitedPage( $default_url )
    {
        $history = $this->allHistory();
        if( $history!=null && count($history) > 0){
            $cnt = count($history);
            return url($history[$cnt-1]['url']);
        }
        return $default_url;
    }
    /**
     * @brief retourne la page précédente visitée(ou la page par defaut si elle n'existe pas)
    */
    public function previousPage( $default_url )
    {
        $history = $this->allHistory();
        if( $history!=null && count($history) >= 2){
            $cnt = count($history);
            return url($history[$cnt-2]['url']);
        }
        return $default_url;
    }

}