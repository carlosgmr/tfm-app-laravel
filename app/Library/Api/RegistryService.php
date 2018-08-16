<?php

namespace App\Library\Api;

/**
 * Clase para interactuar con la API
 *
 * @author carlos
 */
class RegistryService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->resource = 'registry';
    }

    /**
     * Registra las respuesta del usuario para un examen concreto
     * @param string|int $idUser
     * @param string|int $idQuestionary
     * @param array $data
     * @return \App\Library\Api\ServiceResponse
     */
    public function saveAttempt($idUser, $idQuestionary, $data)
    {
        $client = $this->createClient();
        $options = $this->createOptions();
        $options['body'] = json_encode($data);
        $response = $client->request('POST', $this->url.$this->resource.'/user/'.$idUser.'/questionary/'.$idQuestionary, $options);

        return new ServiceResponse($response);
    }
}
