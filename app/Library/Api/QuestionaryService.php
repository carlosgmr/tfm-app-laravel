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

    /**
     * Obtiene el detalle completo de un examen/encuesta
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function readComplete($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.$this->resource.'/'.$id.'/complete', $options);

        return new ServiceResponse($response);
    }
}
