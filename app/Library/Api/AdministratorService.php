<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class AdministratorService extends BaseService
{
    /**
     * 
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function listing(array $data = [])
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['query'] = $data;
        $response = $client->request('GET', $this->url.'administrator', $options);

        return new ServiceResponse($response);
    }

    /**
     * 
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function read($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.'administrator/'.$id, $options);

        return new ServiceResponse($response);
    }

    /**
     * 
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function create(array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.'administrator', $options);

        return new ServiceResponse($response);
    }
}
