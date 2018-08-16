<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /** @var string */
    protected $panel = 'user';
    /** @var string */
    protected $module;

    /**
     * Retorna un array con los ids de los grupos en los que está inscrito 
     * el instructor actual
     * @return array
     */
    protected function getUserGroups()
    {
        $idUser = appUser('id');
        $service = new \App\Library\Api\UserService();
        $serviceResponse = $service->listingGroup($idUser);
        $result = [];

        if ($serviceResponse->isOk()) {
            foreach ($serviceResponse->getData() as $group) {
                $result[] = $group['id'];
            }
        }

        return $result;
    }
}