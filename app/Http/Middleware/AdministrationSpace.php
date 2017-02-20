<?php

namespace OlympicDrive\Http\Middleware;

use Auth;
use Closure;

class AdministrationSpace {
    
    public function handle($request, Closure $next) {
        if (Auth::check() && Auth::user()->isAdminOrEditor()) {
            return $next($request);
        }
        
        return redirect('/');
    }
}
