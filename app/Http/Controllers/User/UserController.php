<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->module = 'user';
    }

    /**
     * Operación básica de lectura
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function read(Request $request, $id)
    {
        $data = [
            'item' => null,
            'groups' => [],
            'apiErrors' => [],
            'id' => $id,
            'validGroups' => [],
        ];

        $service = new \App\Library\Api\UserService();

        $responseRead = $service->read($id);
        if ($responseRead->isOk()) {
            $data['item'] = $responseRead->getData();
        } else {
            $data['apiErrors'] = $responseRead->getListErrors();
        }

        $responseListingGroup = $service->listingGroup($id);
        if ($responseListingGroup->isOk()) {
            $data['groups'] = $responseListingGroup->getData();
            $data['validGroups'] = $this->getUserGroups();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingGroup->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.read', $data);
    }

    /**
     * Obtiene el registro de respuestas para un usuario y examen concretos
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function questionaryDetails(Request $request, $id)
    {
        $data = [
            'idUser' => appUser('id'),
            'idQuestionary' => $id,
            'item' => null,
            'apiErrors' => [],
        ];

        $service = new \App\Library\Api\UserService();
        $response = $service->questionaryDetails(appUser('id'), $id);
        if ($response->isOk()) {
            $data['item'] = $response->getData();
        } else {
            $data['apiErrors'] = $response->getListErrors();
        }

        return view($this->panel.'.'.$this->module.'.questionaryDetails', $data);
    }
}