<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class Authorize
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

        $roles = array_slice(func_get_args(), 2);

        if (Auth::user()->hasARoleIn($roles))
        {
            return $next($request);
        }
        else
        {
            throw new AuthorizationException('Truy cập bị từ chối');
        }
    }
}
