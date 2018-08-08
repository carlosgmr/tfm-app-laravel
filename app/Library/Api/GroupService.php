<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class GroupService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->resource = 'group';
    }

    /**
     * Obtiene el listado de los instructores que están inscritos en el grupo
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function listingInstructor($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.$this->resource.'/'.$id.'/instructor', $options);

        return new ServiceResponse($response);
    }

    /**
     * Obtiene el listado de los usuarios que están inscritos en el grupo
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function listingUser($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.$this->resource.'/'.$id.'/user', $options);

        return new ServiceResponse($response);
    }

    /**
     * Asigna los instructores que pertenece actualmente al grupo
     * @param string|int $id
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function currentInstructor($id, array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.$this->resource.'/'.$id.'/instructor', $options);

        return new ServiceResponse($response);
    }

    /**
     * Asigna los usuarios que pertenece actualmente al grupo
     * @param string|int $id
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function currentUser($id, array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.$this->resource.'/'.$id.'/user', $options);

        return new ServiceResponse($response);
    }
}
