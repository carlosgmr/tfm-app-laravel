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

    public function __construct()
    {
        $this->url = env('API_URL');
    }

    /**
     * 
     * @return Client
     */
    protected function createClient()
    {
        return new Client();
    }

    /**
     * 
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
}
