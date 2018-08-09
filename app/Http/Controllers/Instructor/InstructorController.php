<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Instructor\BaseController;
use Illuminate\Http\Request;

class InstructorController extends BaseController
{
    public function __construct()
    {
        $this->module = 'instructor';
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

        $service = new \App\Library\Api\InstructorService();

        $responseRead = $service->read($id);
        if ($responseRead->isOk()) {
            $data['item'] = $responseRead->getData();
        } else {
            $data['apiErrors'] = $responseRead->getListErrors();
        }

        $responseListingGroup = $service->listingGroup($id);
        if ($responseListingGroup->isOk()) {
            $data['groups'] = $responseListingGroup->getData();
            $data['validGroups'] = $this->getInstructorGroups();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingGroup->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.read', $data);
    }
}