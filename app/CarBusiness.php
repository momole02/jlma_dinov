<?php
/**
  * CarBusiness.php - Implémentation de la logique métier des voitures
 *
 * @author Marc Arnaud A.
 */


namespace jlma;

use Illuminate\Support\Facades\Storage;
use jlma\Leasing;
use jlma\Front_Utils;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class CarBusiness
{

    /**
     * @brief enregistre une demande de location
     *
     * @param post données du formulaire
     * @param client_account_id identifiant du client
     *
     * @return un statut
    */
    public function registerLeasing($post , $client_account_id = 1)
    {
        /// TODO Gérer les erreurs et les renvoyer dans l'array
        /// TODO expression regulières
        ///
        $vehicle = $this->vehicleBySlug($post['leasing-car-slug']);
        if( $vehicle===null ) {
            $status['result'] = 'erreur inattendue';
            $status['success'] = false;
            return $status;
        }
        $begin_date_time = $post['leasing-begin-date'].' '.$post['leasing-begin-time'];
        $end_date_time = $post['leasing-end-date'].' '.$post['leasing-end-time'];
        if( !$this->isCarAvailiable($vehicle , $begin_date_time , $end_date_time)  ){
            $status['result'] = 'Cette voiture est indisponible pour le temps demandé';
            $status['success'] = false;
            return $status;
        }

        $vehicle_id = $vehicle->id_vehicul;
        $status = [];
        $date = new \DateTime(null);

        $renting_price = Front_Utils::rentingPrice($begin_date_time , $end_date_time ,
            $vehicle->prix , $vehicle->prix_mois , $vehicle->prix_an );

        $rentingSlug = Str::slug('loc'.' '.$client_account_id.' '.$date->format('dmYhis'));
        DB::table('jla_location')->insert([
            'fk_id_vehicul' => $vehicle_id ,
            'fk_id_compte' => $client_account_id,
            'loc_date' => strftime('%Y-%m-%d %H:%M:%S'),
            'loc_datedebut' =>  $begin_date_time,
            'loc_datefin' =>  $end_date_time,
            'loc_lieu_remise' => $post['leasing-place'],
            'loc_lieu_circulation' => $post['leasing-roam-place'],
            'loc_prix' => $renting_price,
            'loc_description' => $post['leasing-reason'],
            'slug' => $rentingSlug
        ]);


        $accountBusiness = new AccountBusiness( );
        $account = $accountBusiness->loggedClientData();
        if( $account!=null ){
            $clientName = $account->civilite.' '.$account->prenom.' '.strtoupper( $account->nom );
            EventStock::dispatchEvent( 'NOUVELLE_RESERVATION' ,'Nouvelle reservation',
                $clientName.' a effectué une reservation ' , route('adminRentingCard' , ['slug'=>$rentingSlug]) );
        }

        $status['result'] = 'location enregistrée avec succès';
        $status['success'] = true;
        return $status;

    }

    /**
     * @brief recupère les intervalles de temps pendant lesquels une voitures est occupée
     *
     * @param slug slug de la voiture
     *
     * @retourne une liste d'intervalle (qui peut être eventuellement vide) ou null en cas d'erreurs
    */
    public function carRentingsIntervals( $id )
    {
        $data= DB::table('jla_location')->select('loc_lieu_remise','loc_datedebut' , 'loc_datefin')->where('fk_id_vehicul' , $id)->get();

        for($i=0;$i<count($data);++$i){
            $data[$i]->loc_datedebut = Front_Utils::formatDate($data[$i]->loc_datedebut);
            $data[$i]->loc_datefin = Front_Utils::formatDate($data[$i]->loc_datefin);
        }
        
        return $data;
    }

    /**
     * @brief recupère toutes les location effectuées par un client donné
     *
     * @param account_id Identifiant du client
     *
     * @return les locations
    */
    public function allClientLeasings( $account_id )
    {
        $leasings = DB::table('jla_location')->where('fk_id_compte' , $account_id)->orderby('loc_date','desc')->get();
        for($i=0;$i<count($leasings);++$i){
            /*charger les extra données */
            $vehicle_info = DB::table('jla_vehicul')->where('id_vehicul', $leasings[$i]->fk_id_vehicul)->first();
            $this->fillCarExtraInfo($vehicle_info);

            $vehicle_photo = $vehicle_info->liste_photos[0];
            $vehicle_slug = $vehicle_info->slug;

            $leasings[$i]->photo_vehicule = $vehicle_photo;
            $leasings[$i]->slug_vehicule = $vehicle_slug;
        }
        return $leasings;
    }

    /**
     * @brief recupère toutes les voitures
     *
     * @param offset index de debut
     * @param limit nombre d'éléments à prendre
     *
     * @return toutes les voitures
     */
    public function allCars($offset=0,$limit=10,$userID=null)
    {
        if( $userID==null )
            $cars = DB::table('jla_vehicul')->skip($offset)->take($limit)->get();
        else
            $cars = DB::table('jla_vehicul')->where('fk_id_proprietaire',$userID)->skip($offset)->take($limit)->get();

        for($i=0;$i<count($cars);++$i){

            $this->fillCarExtraInfo( $cars[$i] );
        }
        return $cars;
    }

    private function datetimeBetween( $date1 , $date2 , $date_test )
    {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $time_test = strtotime($date_test);
        if( $time1==FALSE || $time2 == FALSE || $time_test==FALSE )
            return FALSE;
        if(($time_test>=$time1) && ($time_test<=$time2)) {
            return TRUE;
        }
        return FALSE;
    }
    /**
     * @brief recherche les voitures disponibles en fonction des dates données
     * et met le resultat en sessions avec la clé 'jlma-last-car-search'
     *
     * @param begin_date date de début de la location
     * @param begin_time heure de début de la location
     * @param end_date date de fin de la location
     * @param end_time heure de fin de la location
    */
    public function searchCars( $begin_date , $begin_time , $end_date , $end_time )
    {
        $this->begin_date_time = "$begin_date $begin_time";
        $this->end_date_time = "$end_date $end_time";

        $cars = DB::table('jla_vehicul')->distinct()->get();

        /**TODO : Calculer le prix de la location pour chaque voiture*/

        $filteredLeasings = $cars->filter(function($car,$key){
            $begin_date_time =$this->begin_date_time;
            $end_date_time = $this->end_date_time;

            return $this->isCarAvailiable($car , $begin_date_time, $end_date_time);


        });

        $l = array_values($filteredLeasings->all()); /* retransformer en scalaire */
        for($i=0;$i<count($l);++$i) {
            $this->fillCarExtraInfo($l[$i]);
        }
        session()->put( 'jlma-last-car-search-count' , count($l));
        session()->put( 'jlma-last-car-search',$l );
    }

    /**
     * @brief Verifie si une voiture est disponible (pour la reservation ) pendant le laps de temps donné
     *
     * @param car_slug slug de la voiture
     * @param begin_date_time date/heure de début de reservation
     * @param end_date_time date/heure de fin de reservation
     *
     *
    */
    private function isCarAvailiable( $car , $begin_date_time ,  $end_date_time)
    {
        $intervals = $this->carRentingsIntervals( $car->id_vehicul );

        foreach( $intervals as $inter ){
            print $this->datetimeBetween($begin_date_time , $end_date_time , $inter->loc_datedebut);

            if( $this->datetimeBetween($begin_date_time , $end_date_time , $inter->loc_datedebut) ||
                $this->datetimeBetween($begin_date_time , $end_date_time , $inter->loc_datefin )) {
                return false;
            }

            if( $this->datetimeBetween($inter->loc_datedebut , $inter->loc_datefin , $begin_date_time) ||
                $this->datetimeBetween($inter->loc_datedebut , $inter->loc_datefin , $end_date_time)) {
                return false;
            }
        }
        return true;
    }

    /**
     *@brief retourne le nombre pages de la dernière recherche
     *
     * */
    public function lastCarSearchCount()
    {
        if( session()->has('jlma-last-car-search-count') )
            return (int)(session()->get('jlma-last-car-search-count'));
        return 0 ;
    }

    /**
     * @brief retourne les resultats de la dernière recherche si elle existe
     *
    */
    public function lastCarSearchResults( $page=0,$nb_items_per_page=10 )
    {
        if(session()->has( 'jlma-last-car-search' )){

            $lastSearch=session()->get('jlma-last-car-search');
            $col = collect($lastSearch);
            $chunked = $col->chunk($nb_items_per_page);
            if($page>=0 && $page<count($chunked))
                return $chunked[$page];
            return collect([]);
        }
        return collect([]); /* retourner la collection vide */

    }
    /**
     * @brief ajoute les extra-données d'une voiture(le modèle,la marque, le type)
     * depuis les autres tables (avec les clés étrangères)
     *
     */
    private function fillCarExtraInfo( & $car  )
    {

        /* informations sur le client */
        $accountBusiness = new AccountBusiness( ) ;
        $clientData = $accountBusiness->clientDataByAccountID( $car->fk_id_proprietaire );
        $car->ownerName = $clientData->civilite.' '.$clientData->prenom.' '.$clientData->nom;
        $car->ownerCNI = $clientData->numcni;
        $car->ownerContact = $clientData->contact;


        $car->model = $this->carModelById($car->fk_id_model);
        $car->marque = $this->carBrandById($car->fk_id_marque);
        $car->type =   $this->carTypeById($car->fk_id_type_vehic);
        $car->reserv_dates=$this->carRentingsIntervals($car->id_vehicul);


        $imgs = DB::table('jla_image_vehicul')->select('img_chemin')->where('fk_id_vehicule', $car->id_vehicul)->get();
        $car->liste_photos = [];
        foreach($imgs as $img){
            $car->liste_photos[] = $img->img_chemin;
        }

    }


    /**
     * @brief efface une location en fonction du
     *
     * @param slug slug de la location
     *
     * @return le statuts
    */
    public function dropLeasingBySlug( $slug )
    {
        $status = [];

        DB::table('jla_location')->where('slug' , $slug)->delete();


        $status['success'] = true;
        $status['result'] = 'Demande de location effacée avec succès';
        return $status;
    }


    /**
     * @brief compte le nombre de vehicules total
    */
    public function carsCount()
    {
        return DB::table('jla_vehicul')->count() ;
    }

    /**
     * @brief retourne les voitures en fonction d'un offset et d'une limite
     *
     * @param offset décalage
     * @param limit taille des enregistrements à retourner

     * @return les voitures
    */
    public function allCarsInterval( $offset=0 , $limit=10 )
    {
        /* chercher les voiture dont l'id n'est pas dans $avail_cars_id */
        $cars = DB::table('jla_vehicul')
            ->skip($offset)->take($limit)
            ->get();

        /* ajouter des extra-données d'une voiture(le modèle,le type,...) */
        for($i=0;$i<count($cars);++$i){
            $this->fillCarExtraInfo( $cars[$i] );
        }

        return $cars;
    }


    /**
     * @brief Lister les vehicules disponibles
     *
     * @param offset décalage
     * @param limit taille des enregistrements
     *
     * @return les voitures non demandées
    */
    public function availableCars($offset=0,$limit=10)
    {
        /* recupérer les ID des voitures actuellement en demandées */
        $ids = DB::table('jla_location')->distinct()->select('fk_id_vehicul')->get();
        $avail_cars_id = array();
        foreach( $ids as $id )
            array_push( $avail_cars_id , $id->fk_id_vehicul );

        /* chercher les voiture dont l'id n'est pas dans $avail_cars_id */
        $avail_cars = DB::table('jla_vehicul')
            ->whereIn('id_vehicul' , $avail_cars_id , 'and' , true)
            ->skip($offset)->take($limit)
            ->get();

        /* ajouter des extra-données d'une voiture(le modèle,le type,...) */
        for($i=0;$i<count($avail_cars);++$i){
            $this->fillCarExtraInfo( $avail_cars[$i] );
        }

        return $avail_cars;
    }

    /**
     * @brief donne les informations sur le modèle d'un vehicule
     *
     * @param id id du modèle
     *
     * @return les informations sur le modèle
     */
    public function carModelById( $id )
    {
        return DB::table('jla_model')->where('id_model',$id)->first();
    }

    /**
     * @brief donne les informations sur la marque d'un vehicule
     *
     * @param id id de la marque
    */
    public function carBrandById( $id )
    {
        return DB::table('jla_marque')->where('pk_id',$id)->first();
    }
    /**
     * @brief donne les informations sur le type d'un vehicule
     *
     * @param $id id
    */
    public function carTypeById( $id )
    {
        return DB::table('jla_type_vehicul')->where('id_type_vehic',$id)->first();
    }


    /**
     * @brief recupére les données d'un vehicule en fonction du slug
     */

    public function vehicleBySlug( $slug )
    {
        $car = DB::table('jla_vehicul')->where('slug',$slug)->first();

        if($car != null ) {

            $this->fillCarExtraInfo( $car );


            return $car;
        }else{
            return null ;
        }
    }


    public function vehicleImagesBySlug( $slug )
    {

        $car = $this->vehicleBySlug($slug);
        $imgs = DB::table('jla_image_vehicul')->where('fk_id_vehicule', $car->id_vehicul)->get();

        $picturesList = [];
        foreach($imgs as $img){
            $picturesList[] = ['path'=>$img->img_chemin , 'id'=>$img->id_img_vehicule];
        }
        return $picturesList;
    }

    public function dropVehicleImageByID( $id )
    {
        DB::table('jla_image_vehicul')->where('id_img_vehicule',$id)->delete();
    }


    /**
     * @brief Listing de toutes marques des voitures
    */
    public function allCarsBrands()
    {
        $brands = DB::table('jla_marque')->get();

        return $brands;
    }

    /**
     * @brief Listing de tous les modèles
    */
    public function allCarsModels()
    {
        $models = DB::table('jla_model')->get();

        return $models;
    }

    /**
     * @brief Listing de tous les types d'énergie
    */
    public function allEnergies()
    {
        $energies = DB::table('jla_energie')->get();

        return $energies;
    }

    /**
     * @brief Listing des types de vehicules
    */
    public function allVehicleTypes()
    {
        $types = DB::table('jla_type_vehicul')->get();

        return $types;
    }

    /**
     * @brief Recupère tous les documents relatifs à un véhicule
    */
    public function allVehicleDocuments( $slug )
    {
        $vehicle = $this->vehicleBySlug( $slug );
        if( $vehicle!=null ){
            $documents = DB::table('jla_document_vehicule')->where( 'fk_id_vehicule',$vehicle->id_vehicul )->get();

            return $documents;

        }

        return null ;
    }

    /**
     *@brief Ajoute un nouveau vehicule
     *
     * @param $car_registration_number matricule du vehicule
     * @param $car_color couleur du vehicule
     * @param $car_year Année de fabrique du véhicule
     * @param $car_description description du vehicule
     * @param $car_doors_count nombre de portes du véhicule
     * @param $car_places_count nombre de places
     * @param $car_brand_id ID de la marque du véhicule
     * @param $car_model_id ID du modèle du véhicule
     * @param $car_type_id  ID du type de véhicule
     * @param $car_km kilométrage
     * @param $car_country Pays d'origine du véhicule
     * @param $car_registration_year Année d'immatriculation du véhicule
     * @param $car_consumption consommation du véhicule
     * @param $car_energy consommation du véhicule
     * @param $car_speed_box Boite à vitesse
     * @param $car_horses_count nombre de chevaux
     * @param $car_day_price prix par jour
     * @param $car_week_prince prix par semaine
     * @param $car_month_price prix par mois
     * @param $car_year_price prix par an
     * @param $last_vehicles_page dernière page de l'affichage des véhicules
     *
     * @return sur la page des vehicules
     */
    public function addVehicle( $car_registration_number ,
                                $car_color ,
                                $car_year ,
                                $car_description,
                                $car_doors_count,
                                $car_places_count,
                                $car_brand_id,
                                $car_model_id,
                                $car_type_id,
                                $car_km,
                                $car_country,
                                $car_registration_year,
                                $car_consumption,
                                $car_energy,
                                $car_speed_box,
                                $car_horses_count,
                                $car_day_price,
                                $car_week_price,
                                $car_month_price,
                                $car_year_price,
                                $car_owner_account_ID
                                )
    {

        DB::table('jla_vehicul')->insert([
            'slug'=>Front_Utils::makeSlug($car_registration_number),
            'vehic_immat'=>$car_registration_number,
            'couleur' => $car_color,
            'annee' => $car_year,
            'description' => $car_description,
            'nb_porte' => $car_doors_count,
            'nb_place' => $car_places_count,
            'fk_id_marque'=> $car_brand_id,
            'fk_id_model' => $car_model_id,
            'fk_id_type_vehic' => $car_type_id,
            'kilometrage' => $car_km,
            'pays' => $car_country,
            'annee_immat' =>$car_registration_year,
            'consommation' =>$car_consumption,
            'energie' =>$car_energy,
            'boite_vitesse' => $car_speed_box,
            'cv_fiscaux' =>$car_horses_count,
            'prix' => $car_day_price,
            'prix_semaine' => $car_week_price,
            'prix_mois' =>$car_month_price,
            'prix_an' => $car_year_price,
            'fk_id_proprietaire' => $car_owner_account_ID,
         ]);
    }



    /**
     * @brief Modifie un vehicule connaissant sont slug et les détails sur lui
     *
     * @param $car_registration_number matricule du vehicule
     * @param $car_color couleur du vehicule
     * @param $car_year Année de fabrique du véhicule
     * @param $car_description description du vehicule
     * @param $car_doors_count nombre de portes du véhicule
     * @param $car_places_count nombre de places
     * @param $car_brand_id ID de la marque du véhicule
     * @param $car_model_id ID du modèle du véhicule
     * @param $car_type_id  ID du type de véhicule
     * @param $car_km kilométrage
     * @param $car_country Pays d'origine du véhicule
     * @param $car_registration_year Année d'immatriculation du véhicule
     * @param $car_consumption consommation du véhicule
     * @param $car_energy consommation du véhicule
     * @param $car_speed_box Boite à vitesse
     * @param $car_horses_count nombre de chevaux
     * @param $car_day_price prix par jour
     * @param $car_week_price prix par semaine
     * @param $car_month_price prix par mois
     * @param $car_year_price prix par an
     *
     * @param $car_slug slug du véhicule
     */
    public function editVehicle( $car_registration_number ,
                                 $car_color ,
                                 $car_year ,
                                 $car_description,
                                 $car_doors_count,
                                 $car_places_count,
                                 $car_brand_id,
                                 $car_model_id,
                                 $car_type_id,
                                 $car_km,
                                 $car_country,
                                 $car_registration_year,
                                 $car_consumption,
                                 $car_energy,
                                 $car_speed_box,
                                 $car_horses_count,
                                 $car_day_price,
                                 $car_week_price,
                                 $car_month_price,
                                 $car_year_price,
                                 $car_slug)
    {

        DB::table('jla_vehicul')->where('slug' , $car_slug)->update(
            [
                'vehic_immat'=>$car_registration_number,
                'couleur' => $car_color,
                'annee' => $car_year,
                'description' => $car_description,
                'nb_porte' => $car_doors_count,
                'nb_place' => $car_places_count,
                'fk_id_marque'=> $car_brand_id,
                'fk_id_model' => $car_model_id,
                'fk_id_type_vehic' => $car_type_id,
                'kilometrage' => $car_km,
                'pays' => $car_country,
                'annee_immat' =>$car_registration_year,
                'consommation' =>$car_consumption,
                'energie' =>$car_energy,
                'boite_vitesse' => $car_speed_box,
                'cv_fiscaux' =>$car_horses_count,
                'prix' => $car_day_price,
                'prix_semaine' => $car_week_price,
                'prix_mois' =>$car_month_price,
                'prix_an' => $car_year_price]
        );
    }

    /**
     * @brief Ajoute une image au véhicule spécifié
     *
     * @param $car_slug slug de la voiture
     * @param $img_path chemin de la voiture
    */
    public function addVehicleImage( $car_slug , $img_path )
    {
        $fileSize = Storage::size( $img_path );
        $addDatetime = date('Y-m-d H:i:s');
        $pathInfo = pathinfo( $img_path );
        $ext = $pathInfo['extension'];
        $imgLabel = str_replace('/','X',$img_path);


        $vehicle = $this->vehicleBySlug($car_slug);

        DB::table('jla_image_vehicul')->insert([
            'img_libelle' => $imgLabel,
            'img_taille' => $fileSize,
            'img_extension' => $ext,
            'img_chemin'=>$img_path,
            'img_date_ajout' => $addDatetime,
            'fk_id_vehicule' => $vehicle->id_vehicul
        ]);
    }

    /**
     * @brief Modifie la vidéo d'un véhicule
     *
     * @param $car_slug slug du vehicule
     * @param $video_link lien de la vidéo
    */
    public function changeVehicleVideoLink( $car_slug , $video_link )
    {
        DB::table('jla_vehicul')->where('slug' , $car_slug)->update(['lien_video'=>$video_link]);
    }

    /**
     * @brief supprime un vehicule
    */
    public function dropVehicleBySlug( $slug )
    {
        DB::table('jla_vehicul')->where('slug' , $slug)->delete(); 
    }

    /**
     * @brief ajoute un document au véhicule
     *
     * @param $car_slug slug du vehicule
     * @param $title intitulé du document
     * @param $file_path chemin du document
     * @param $description description du véhicule
    */
    public function addVehicleDoc( $car_slug , $title , $file_path, $description )
    {
        $vehicle = $this->vehicleBySlug( $car_slug );

        if( $vehicle!=null ){
            $documentSlug = Front_Utils::makeSlug( $title );
            DB::table('jla_document_vehicule')->insert([
                'titre_doc' => $title,
                'chemin_doc' => $file_path,
                'description_doc' => $description,
                'slug' => $documentSlug,
                'fk_id_vehicule' => $vehicle->id_vehicul
            ]);
        }
        return null;
    }

    /**
     * Supprime un document en fonction du slug
    */
    public function dropVehicleDocument( $document_slug)
    {
        DB::table('jla_document_vehicule')->where('slug',$document_slug)->delete();

    }
    

    /**
     * @brief Intervalle minmax des années
     * */
    public function yearsMinMax()
    {
        $data = DB::table('jla_vehicul')->select(DB::raw('MAX(annee) AS annee_max , MIN(annee) AS annee_min '))->first();

        list($min,$max) = [$data->annee_min,$data->annee_max];

        if($max-$min<=10) $min-=10;

        /*arrondir le min au multiple de 10 inf*/
        $mod=$max%10;
        $min=$min-$mod;

        /*arrondir le max au multiple de 10 sup*/
        $mod=$max%10;
        $max=$max-$mod+10;

        return ['min'=>$min,'max'=>$max];

    }

    /**
     * @brief Intervalle minmax du kilométrage
    */
    public function kmMinMax()
    {
        $data = DB::table('jla_vehicul')->select(DB::raw('MAX(fk_id_kilometrage) AS kilo_max , MIN(fk_id_kilometrage) AS kilo_min '))->first();

        list($min,$max) = [$data->kilo_min,$data->kilo_max];

        if($max-$min<=10) $min-=100;

        /*arrondir le min au multiple de 100 inf*/
        $mod=$max%100;
        $min=$min-$mod;

        /*arrondir le max au multiple de 100 sup*/
        $mod=$max%100;
        $max=$max-$mod+100;

        return ['min'=>$min,'max'=>$max];
    }

    /**
     * @brief Intervalle des prix par jours
    */
    public function priceMinMax()
    {
        $data = DB::table('jla_vehicul')->select(DB::raw('MAX(prix) AS prix_max , MIN(prix) AS prix_min '))->first();

        list($min,$max) = [$data->prix_min,$data->prix_max];

        return ['min'=>$min,'max'=>$max];
    }

    /**
     * @brief Listing des reservations avec informations supplémentaires
     *
     *
     */
    public function allRentings( $offset=0,$limit=10,$userID=null )
    {
        $rentings = ($userID==null)
            ? DB::table('jla_location')->get()
            : DB::table('jla_location')->where('fk_id_compte' , $userID)->get();


        for( $i=0;$i<count($rentings);++$i ) {

            $this->storeRentingExtraData($rentings[$i]);

        }
        return $rentings;
    }

    /**
     * @brief recupère les informations sur une reservation
    */
    public function rentingBySlug( $slug )
    {
        $renting = DB::table('jla_location')->where( 'slug',$slug )->first();

        if( $renting!=null ){
            $this->storeRentingExtraData( $renting );
            return $renting ;
        }
        return null ;

    }

    /**
     * @brief charge les extradonnées sur une reservation
     *
     * @param $renting objet a remplir
    */
    public function storeRentingExtraData( & $renting )
    {

        /* extra données */
        $clientName = null;
        $clientContact = null;
        $clientMail = null ;
        $vehicleBrandModel = null;
        $vehicleRegistrationNumber=null;
        $vehicleSlug=null;
        $accountSlug=null;
        $vehicleOwnerName=null;
        $vehicleOwnerContact=null;

        /* Recupérer qq informations sur le client */
        $accountInfo = DB::table('jla_compte')->where( 'id_compte',$renting->fk_id_compte )->first();
        if( $accountInfo!=null ){
            $clientInfo = DB::table('jla_client')->where( 'id_client' , $accountInfo->fk_id_client )->first();
            if( $clientInfo!=null ){
                $clientName = $clientInfo->civilite.' '.$clientInfo->prenom.' '.strtoupper($clientInfo->nom);
                $clientContact = $clientInfo->contact;
                $clientMail = $clientInfo->email;
                $accountSlug = $accountInfo->slug;
            }
        }

        /* recupérer qq informations sur le vehicule */
        $vehicleInfo = DB::table('jla_vehicul')->where( 'id_vehicul',$renting->fk_id_vehicul )->first();
        if( $vehicleInfo!=null ){

            $vehicleSlug = $vehicleInfo->slug;
            $vehicleFullInfo = $this->vehicleBySlug($vehicleSlug);
            $vehicleBrandModel = $vehicleFullInfo->marque->libelle_marque.' '.$vehicleFullInfo->model->libelle_model;
            $vehicleRegistrationNumber = $vehicleFullInfo->vehic_immat;
            $vehicleOwnerName = $vehicleFullInfo->ownerName;
            $vehicleOwnerContact = $vehicleFullInfo->ownerContact;

        }

        $renting->clientName = $clientName;
        $renting->clientMail = $clientMail;
        $renting->clientContact = $clientContact;
        $renting->vehicleBrandModel = $vehicleBrandModel;
        $renting->vehicleRegistrationNumber = $vehicleRegistrationNumber;
        $renting->vehicleSlug = $vehicleSlug;
        $renting->accountSlug = $accountSlug;
        $renting->vehicleOwnerName = $vehicleOwnerName;
        $renting->vehicleOwnerContact = $vehicleOwnerContact;
    }


    /**
     * @brief nombre de reservations */
    public function rentingCount()
    {
        return DB::table('jla_location')->count();
    }

    /**
     * @brief Supprime une reservation
    */
    public function dropRenting( $slug )
    {
        return DB::table('jla_location')->where('slug',$slug)->delete();
    }

    /**
     * @brief Accepte une reservation
    */
    public function acceptRenting( $slug )
    {
        return DB::table('jla_location')->where('slug',$slug)->update(['accepte'=>1]);
    }

    /**
     * @brief retourne les resultats d'une recherche de reservation(dans une période)
     *
     * @param period_begin_date Date de debut de la période
     * @param period_begin_time Heure de début de la période
     * @param period_end_date Date de fin de la périod
     * @param period_end_time Heure de fin de la période
     * @param accepted accepté ou pas
     */
    public function searchRentings( $period_begin_date , $period_begin_time , $period_end_date , $period_end_time , $accepted )
    {
        $queryBase = DB::table('jla_location');
        if( $period_begin_date!=null && $period_begin_time!=null &&
            $period_end_date!=null && $period_end_time!=null ){
            $beginDateTime =  $period_begin_date.' '.$period_begin_time;
            $endDateTime = $period_end_date.' '.$period_end_time;
            $queryBase = $queryBase->whereBetween( 'loc_datedebut' , [$beginDateTime , $endDateTime] )
                ->whereBetween( 'loc_datefin',[$beginDateTime , $endDateTime] ); /* toute la période de location est comprise à l'intérieur de ce qui à été fourni */
        }

        $queryBase->where( 'accepte' , $accepted ? 1 : 0 );

        $rentings = $queryBase->get();
        for($i=0;$i<count($rentings);++$i){
            $this->storeRentingExtraData( $rentings[$i] );
        }
        return $rentings;
    }


    /**
     * @brief retourne les reservations du client
     *
     * @param $accountID ID du compte
    */
    public function rentingsByAccountID( $accountID )
    {
        $rentings = DB::table('jla_location')->where('fk_id_compte',$accountID)->get();

        for($i=0;$i<count($rentings);++$i){
            $this->storeRentingExtraData($rentings[$i]);
        }
        return $rentings;

    }

    /**
     * @brief retourne les véhicules du client
     *
     * @param $accountID ID du compte
    */
    public function vehiclesByAccountID( $accountID )
    {
        $vehicles = DB::table('jla_vehicul')->where('fk_id_proprietaire',$accountID)->get();
        for($i=0;$i<count($vehicles);++$i){
            $this->fillCarExtraInfo($vehicles[$i]);
        }
        return $vehicles;
    }


    /**
     * @brief insert une nouvelle marque et retourne son ID
     *
     * @param $name nom de la marque
     */
    public function insertBrandAndGetID( $name )
    {
        return DB::table('jla_marque')->insertGetId(['libelle_marque'=>$name]);

    }

    /**
     * @brief insert un nouveau modèle et retourne son ID
     *
     * @param $name nom du modèle
     */
    public function insertModelAndGetID( $name )
    {
        return DB::table('jla_model')->insertGetId( ['libelle_model' => $name] );
    }

    /**
     * @brief insert un nouveau type de véhicule et retourne son ID
     *
     * @param $name nom du type
     */
    public function insertTypeAndGetID( $name )
    {
        return DB::table('jla_type_vehicul')->insertGetId(['libelle_type_vehic' => $name]);
    }


    /**
     *  @brief supprime une marque
     *
     *  @param $id de la marque
     */
    public function dropVehicleBrand( $id  )
    {
        DB::table('jla_marque')->where( 'pk_id',$id )->delete();
    }

    /**
     * @brief supprime un modèle
     *
     * @param $id du modèle
    */
    public function dropVehicleModel( $id )
    {
        DB::table('jla_model')->where( 'id_model' , $id )->delete();
    }
    /**
     * @brief supprime un type de véhicule
     *
     * @param $id id du type
    */
    public function dropVehicleType( $id )
    {
        DB::table('jla_type_vehicul')->where( 'id_type_vehic' , $id )->delete();
    }





}