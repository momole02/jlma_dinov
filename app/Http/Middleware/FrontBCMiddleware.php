<?php

namespace jlma\Http\Middleware;

use Closure;
use jlma\FrontBreadcrumb;

class FrontBCMiddleware
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
        $adminBreadcrumb = new FrontBreadcrumb();
        $adminBreadcrumb->insertHistoryPage( $request->route()->getName() , $request->path() );

        return $next($request);
    }
}
