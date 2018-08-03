<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class AuthService extends BaseService
{
    /**
     * 
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function login(array $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions(false);
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.'auth/login', $options);

        return new ServiceResponse($response);
    }
}
