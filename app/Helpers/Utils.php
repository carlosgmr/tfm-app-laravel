<?php

if (!function_exists('formatEnDate')) {
    /**
     * 
     * @param string $strDate
     * @param string $format
     * @return string|null
     */
    function formatEnDate($strDate, $format)
    {
        $date = false;

        if ($strDate) {
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $strDate);
        }

        return $date !== false ? $date->format($format) : null;
    }
}

if (!function_exists('esDatetime')) {
    /**
     * Formatea una fecha en formato internacional (Y-m-d H:i:s) a una fecha
     * española (d-m-Y H:i:s)
     * @param string $strDate
     * @return string|null
     */
    function esDatetime($strDate)
    {
        return formatEnDate($strDate, 'd/m/Y H:i:s');
    }
}

if (!function_exists('strBool')) {
    /**
     * 
     * @param mixed $value
     * @return string|null
     */
    function strBool($value)
    {
        if ($value === true || $value === 1 || $value === '1' || strtolower($value) === 'true') {
            return 'Sí';
        }

        if ($value === false || $value === 0 || $value === '0' || strtolower($value) === 'false') {
            return 'No';
        }

        return null;
    }
}

if (!function_exists('appUser')) {
    /**
     * Comprueba si la variable de sesión donde se guardan los datos del usuario
     * está inicializada y, en caso de ser así, si existe la propiedad solicitada
     * @param string $property
     * @param mixed $default
     * @return mixed
     */
    function appUser($property, $default = null)
    {
        $appUser = session('appUser', null);

        if (!$appUser) {
            return $default;
        }

        return $appUser[$property] ?? $default;
    }
}

if (!function_exists('urlHome')) {
    /**
     * Devuelve la url de inicio de acuerdo al rol del usuario que ha iniciado sesión
     * @return string|null
     */
    function urlHome()
    {
        switch (appUser('role')) {
            case 'administrator':
                $route = route('administrator.home');
                break;
            case 'administrator':
                $route = route('instructor.home');
                break;
            case 'administrator':
                $route = route('user.home');
                break;
            default:
                $route = null;
        }

        return $route;
    }
}

if (!function_exists('getModule')) {
    /**
     * Devuelve el nombre del módulo para la ruta actual
     * @return string|null
     */
    function getModule()
    {
        $routeName = request()->route()->getName();
        $routeArray = explode('.', $routeName);
        return $routeArray[1] ?? null;
    }
}

if (!function_exists('nl2brV2')) {
    /**
     * Devuelve el nombre del módulo para la ruta actual
     * @return string|null
     */
    function nl2brV2($str)
    {
        return preg_replace('/\\\n|\n/', '<br>', htmlspecialchars($str));
    }
}