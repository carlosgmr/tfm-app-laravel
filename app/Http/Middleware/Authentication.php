<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Clase middleware que comprueba si el usuario ha iniciado sesión
 *
 * @author carlos
 */
class Authentication
{
    /** @var array */
    private $publicRoutes = [
        'login',
        'login.proccess',
        //'logout',
    ];

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

        if (!$appUser && !in_array($routeName, $this->publicRoutes)) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
