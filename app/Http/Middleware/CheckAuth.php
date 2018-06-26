<?php
/**
 * CheckAuth.php
 * ******************************
 *  Middleware permettant de gérer :
 *      l'authentification
 *      les droits d'accès
 */

namespace jlma\Http\Middleware;

use Closure;
use jlma\AccountBusiness;
use jlma\Rights;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $acountBusiness = new AccountBusiness();
        if( !$acountBusiness->isClientConnected() )
            return redirect()->route('adminLogin');
        else{
            /*verifier les droit*/
            if( !Rights::routeAuthorizedForCurrentUser( $request->route()->getName() ) ){
                return response(null ,403 );
            }
        }

        return $next($request);
    }
}
