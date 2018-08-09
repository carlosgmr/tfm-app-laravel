<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Clase middleware que comprueba si el usuario tiene acceso a la ruta solicitada
 *
 * @author carlos
 */
class Authorization
{
    /** @var array */
    private $publicRoutes = [
        'login',
        'login.proccess',
        'logout',
    ];

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();

        // si es una ruta pública, continua
        if (in_array($routeName, $this->publicRoutes)) {
            return $next($request);
        }

        $routeParts = explode('.', $routeName);
        $panel = $routeParts[0];
        $appUser = session('appUser');

        if ($appUser['role'] !== $panel) {
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
