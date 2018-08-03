<?php

namespace App\Library\Api;

use GuzzleHttp\Psr7\Response;

/**
 * Description of ServiceResponse
 *
 * @author carlos
 */
class ServiceResponse
{
    /** @var int */
    private $statusCode;
    /** @var array */
    private $data;
    /** @var bool */
    private $ok;

    public function __construct(Response $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->data = json_decode($response->getBody()->getContents(), true);
        $this->ok = ($this->statusCode >= 200 && $this->statusCode < 300);
    }

    /**
     * 
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 
     * @return bool
     */
    public function isOk()
    {
        return $this->ok;
    }

    /**
     * 
     * @return array
     */
    public function getListErrors()
    {
        $errors = [];

        foreach ($this->data as $row) {
            foreach ($row as $error) {
                $errors[] = $error;
            }
        }

        return $errors;
    }
}
