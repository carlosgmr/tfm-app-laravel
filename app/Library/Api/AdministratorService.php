<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class AdministratorService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->resource = 'administrator';
    }
}
