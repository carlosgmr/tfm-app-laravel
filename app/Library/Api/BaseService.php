<?php

namespace App\Library\Api;

use GuzzleHttp\Client;

/**
 * Clase base para interactuar con la API
 *
 * @author carlos
 */
class BaseService
{
    /** @var string */
    protected $url;

    /** @var string */
    protected $resource;

    public function __construct()
    {
        $this->url = env('API_URL');
    }

    /**
     * Retorna un nuevo HTTP Client
     * @return Client
     */
    protected function createClient()
    {
        return new Client();
    }

    /**
     * Retorna un array con la configuración básica de un HTTP Client
     * @param bool $addAuthorization
     * @return array
     */
    protected function createOptions($addAuthorization = true)
    {
        $options = [
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];

        if ($addAuthorization) {
            $options['headers']['Authorization'] = session('token');
        }

        return $options;
    }

    /**
     * Operación básica de listado
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function listing(array $data = [])
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['query'] = $data;
        $response = $client->request('GET', $this->url.$this->resource, $options);

        return new ServiceResponse($response);
    }

    /**
     * Operación básica de lectura
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function read($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('GET', $this->url.$this->resource.'/'.$id, $options);

        return new ServiceResponse($response);
    }

    /**
     * Operación básica de creación
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function create(array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.$this->resource, $options);

        return new ServiceResponse($response);
    }

    /**
     * Operación básica de actualización
     * @param string|int $id
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function update($id, array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('PATCH', $this->url.$this->resource.'/'.$id, $options);

        return new ServiceResponse($response);
    }

    /**
     * Operación básica de borrado
     * @param string|int $id
     * @return \App\Library\Api\ServiceResponse
     */
    public function delete($id)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $response = $client->request('DELETE', $this->url.$this->resource.'/'.$id, $options);

        return new ServiceResponse($response);
    }
}
