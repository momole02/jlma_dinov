<?php

namespace jlma\Http\Controllers;

use Illuminate\Http\Request;
use jlma\CarSellBusiness; 

class CarSellController extends Controller
{
    public function doPostBuy( Request $req )
    {
    	$buyPrice = $req->post('buy-price');
    	$buyAmount = $req->post('buy-amount');
    	$slug = $req->post('slug');

    	CarSellBusiness::postBuyRequest($slug, $buyAmount , $buyPrice);
    	
		$previousUrl = session()->previousUrl()!=null 
		? session()->previousUrl()
		: route('home');

		return redirect( $previousUrl );
    }

    public function dropBuy( $slug )
    {
        CarSellBusiness::dropBuyRequest( $slug );

        return redirect( )->route('carDetails' , ['slug' => $slug]) ;
    }
}
