<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class QuestionaryService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->resource = 'questionary';
    }
}
