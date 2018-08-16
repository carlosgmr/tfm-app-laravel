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

    /**
     * Obtiene el detalle básico de un examen/encuesta
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function readBasic($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.$this->resource.'/'.$id.'/basic', $options);

        return new ServiceResponse($response);
    }

    /**
     * Añade un listado de preguntas y respuestas a un questionary
     * @param string|int $id
     * @param string|array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function addQuestions($id, $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = is_array($data) ? json_encode($data) : $data;
        $response = $client->request('POST', $this->url.$this->resource.'/'.$id.'/add-questions', $options);

        return new ServiceResponse($response);
    }
}
