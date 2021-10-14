<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

use Closure;

class UserLogado
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
        if (!$request->session()->has('userLogado')){           
            return redirect('/login');
        }       

        return $next($request);
    }
}

    
