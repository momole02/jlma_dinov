<?php

/**
 * BreadcrumbMiddleware.php
 * ******************************
 *
 *  Middleware peurmettant de gérer :
 *      les historiqes de navigation(breadcrumbs)
*/
namespace jlma\Http\Middleware;

use Closure;
use jlma\AccountBusiness;
use jlma\AdminBreadcrumb;

class BreadcrumbMiddleware
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


        $adminBreadcrumb = new AdminBreadcrumb();
        $adminBreadcrumb->insertHistoryPage( $request->route()->getName() , $request->path() );

        return $next($request);
    }
}
