<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Instructor\BaseController;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    public function __construct()
    {
        $this->module = 'group';
    }

    /**
     * Operación básica de listado
     * @param Request $request
     * @return mixed
     */
    public function listing(Request $request)
    {
        $idInstructor = appUser('id');
        $service = new \App\Library\Api\InstructorService();
        $serviceResponse = $service->listingGroup($idInstructor);
        $data = [
            'items' => [],
            'apiErrors' => [],
        ];

        if ($serviceResponse->isOk()) {
            $data['items'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
        }

        return view($this->panel.'.'.$this->module.'.listing', $data);
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
            'instructors' => [],
            'users' => [],
            'questionarys' => [],
            'apiErrors' => [],
            'id' => $id,
        ];

        $service = new \App\Library\Api\GroupService();

        $responseRead = $service->read($id);
        if ($responseRead->isOk()) {
            $data['item'] = $responseRead->getData();
        } else {
            $data['apiErrors'] = $responseRead->getListErrors();
        }

        $responseListingInstructor = $service->listingInstructor($id);
        if ($responseListingInstructor->isOk()) {
            $data['instructors'] = $responseListingInstructor->getData();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingInstructor->getListErrors());
        }

        $responseListingUser = $service->listingUser($id);
        if ($responseListingUser->isOk()) {
            $data['users'] = $responseListingUser->getData();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingUser->getListErrors());
        }

        $questionaryService = new \App\Library\Api\QuestionaryService();
        $responseListingQuestionary = $questionaryService->listing(['group' => $id]);
        if ($responseListingQuestionary->isOk()) {
            $data['questionarys'] = $responseListingQuestionary->getData();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingQuestionary->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.read', $data);
    }
}