<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->resource = 'user';
    }
}
