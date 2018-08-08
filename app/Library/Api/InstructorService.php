<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class InstructorService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->resource = 'instructor';
    }

    /**
     * Obtiene el listado de los grupos a los que pertenece el instructor
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function listingGroup($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.$this->resource.'/'.$id.'/group', $options);

        return new ServiceResponse($response);
    }

    /**
     * Asigna los grupos a los que pertenece el instructor actualmente
     * @param string|int $id
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function currentGroup($id, array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.$this->resource.'/'.$id.'/group', $options);

        return new ServiceResponse($response);
    }
}
