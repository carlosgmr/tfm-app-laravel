<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Description of Authentication
 *
 * @author carlos
 */
class Authentication
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $appUser = session('appUser');
        $routeName = $request->route()->getName();

        if (!$appUser && !in_array($routeName, ['login', 'login.proccess'])) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
