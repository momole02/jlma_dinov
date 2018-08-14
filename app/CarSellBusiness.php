<?php 

/*
	CarSellBusiness.php

	Classe métier permettant de gérer les ventes de véhicules 
	et les négociations
*/

namespace jlma ;

use Illuminate\Support\Facades\DB;
use jlma\AccountBusiness;

class CarSellBusiness
{
	/**
		@brief verifie si le véhicule est disponible pour achat

		@param slug slug du véhicule

		@return 
			1 si le vehicule est dispo
			0 s'il n'est pas dispo 
			2 s'lil est en rupture de stock
			-1 dans les autres cas
	*/
	public static function isVehicleAvailiableForBuy( $slug )
	{
		$vehicle = DB::table('jla_vehicul')->where('slug' , $slug)->first();
		if( $vehicle!=null ){

			if( $vehicle->prix_vente!=null || $vehicle->prix_vente!=0 ){
				if( $vehicle->stock_dispo!=0){
					return 1;
				}
				return 2;
			}else{
				return 0;
			}

		}
		return (-1);
	}

	
	public static function postBuyRequest( 
		$slug ,
		$user_id, 
		$amount,
		$wanted_price ,
		$negociate)
	{
	
		$carBusiness = new CarBusiness( );
		$vehicle= $carBusiness->vehicleBySlug( $slug );
		
		if( $vehicle!=null ){
			$vehicleID = $vehicle->id_vehicul;

			$id = DB::table('jla_requete_achat')->insertGetId([
				'date_req' => date('Y-m-d H:i:s'),
				'fk_id_compte' => $user_id,
				'fk_id_vehicul' => $vehicleID,
				'prop_accepte' => '0',
				'admin_accepte' => '0'
			]);

			/* inscrire sa négociation de prix */

			DB::table('jla_negociation_achat')->insert([
				'date_neg' => date('Y-m-d h:i:s'),
				'id_req_achat' => $id,
				'prix_neg' => $wanted_price * (($negociate==false)?$amount:1),
				'qte_neg' => $amount, 
				'prop_neg' => 0
			]);

		}
	}

	/*
		retourne true si l'utilisateur à déja demander la voiture
		retourne false sinon
		retourne -1 si aucun utilisateur n'est connecté
	*/
	public static function currentUserHasBuyRequest( $car_id  )
	{
		$loggedAccount = (new AccountBusiness())->loggedAccountData( );
		if( $loggedAccount==null )
			return -1 ; 
		return DB::table('jla_requete_achat')->where( 'fk_id_compte' , $loggedAccount->id_compte )
		->where( 'fk_id_vehicul' ,$car_id )->exists( );
	}

	/*
		retourne toutes les négociations liés
		à l'utilisateur actuellement connecté et à la 
		voiture spécifiée
	*/

	public static function allUserNegociations( $car_id )
	{
		$loggedAccount = (new AccountBusiness())->loggedAccountData() ;
		if( $loggedAccount==null )
			return [];

		$buyRequest = DB::table('jla_requete_achat')->where( 'fk_id_vehicul', $car_id )
		->where('fk_id_compte' , $loggedAccount->id_compte)->first();
		if( $buyRequest==null )
			return [ ];

		return DB::table('jla_negociation_achat')
				->where( 'id_req_achat' , $buyRequest->id_req )->get();

	}

	/**
		Efface une requete d'achat
	*/
	public static function dropBuyRequest( $car_slug )
	{
		$vehicle = (new CarBusiness())->vehicleBySlug( $car_slug );
		/* recupérer l'ID de l'user */
		$loggedAccount= ( new AccountBusiness() )->loggedAccountData( );

		if( $vehicle != null && $loggedAccount!=null ){
			DB::table('jla_requete_achat')->where( 'fk_id_compte' , $loggedAccount->id_compte )
			->where( 'fk_id_vehicul' , $vehicle->id_vehicul )->delete(  );
		}
	}
}
