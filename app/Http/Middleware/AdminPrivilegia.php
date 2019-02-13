<?php

namespace App\Http\Middleware;

use App\Helper\MenuCreator;
use Closure;

class AdminPrivilegia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$module,$priv)
    {
        if (MenuCreator::hasPriv($module,$priv)){
            return $next($request);
        }
        else{
            return response()->view('admin.errors.403',[],403);
        }
    }
}
