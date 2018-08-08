<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class GroupController extends CrudController
{
    public function __construct()
    {
        $this->serviceClass = \App\Library\Api\GroupService::class;
        $this->panel = 'administrator';
        $this->module = 'group';
        $this->rulesForCreate = [
            'name' => 'required',
            'description' => 'nullable',
            'active' => 'required',
        ];
        $this->rulesForUpdate = [
            'name' => 'required',
            'description' => 'nullable',
            'active' => 'required',
        ];
    }

    public function read(Request $request, $id)
    {
        $data = [
            'item' => null,
            'instructors' => [],
            'users' => [],
            'apiErrors' => [],
            'id' => $id,
        ];

        $service = new $this->serviceClass();

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

        return view($this->panel.'.'.$this->module.'.read', $data);
    }

    /**
     * Acción para inscribir instructores al grupo (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function instructorView(Request $request, $id)
    {
        $data = [
            'allInstructors' => [],
            'currentInstructors' => [],
            'apiErrors' => [],
            'id' => $id,
        ];

        $instructorService = new \App\Library\Api\InstructorService();
        $responseAllInstructors = $instructorService->listing();
        if ($responseAllInstructors->isOk()) {
            $data['allInstructors'] = $responseAllInstructors->getData();
        } else {
            $data['apiErrors'] = $responseAllInstructors->getListErrors();
        }

        $service = new $this->serviceClass();
        $responseCurrentInstructors = $service->listingInstructor($id);
        if ($responseCurrentInstructors->isOk()) {
            foreach ($responseCurrentInstructors->getData() as $group) {
                $data['currentInstructors'][] = $group['id'];
            }
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseCurrentInstructors->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.instructor', $data);
    }

    /**
     * Acción para inscribir instructores al grupo (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function instructorProcess(Request $request, $id)
    {
        $data = $request->validate([
            'instructor' => 'array'
        ]);

        if (!isset($data['instructor'])) {
            $data['instructor'] = [];
        }

        array_walk($data['instructor'], function(&$value){ $value = (int)$value; });

        $service = new $this->serviceClass();
        $serviceResponse = $service->currentInstructor($id, $data);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $id])
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.instructorView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }

    /**
     * Acción para inscribir usuarios al grupo (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function userView(Request $request, $id)
    {
        $data = [
            'allUsers' => [],
            'currentUsers' => [],
            'apiErrors' => [],
            'id' => $id,
        ];

        $userService = new \App\Library\Api\UserService();
        $responseAllUsers = $userService->listing();
        if ($responseAllUsers->isOk()) {
            $data['allUsers'] = $responseAllUsers->getData();
        } else {
            $data['apiErrors'] = $responseAllUsers->getListErrors();
        }

        $service = new $this->serviceClass();
        $responseCurrentUsers = $service->listingUser($id);
        if ($responseCurrentUsers->isOk()) {
            foreach ($responseCurrentUsers->getData() as $group) {
                $data['currentUsers'][] = $group['id'];
            }
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseCurrentUsers->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.user', $data);
    }

    /**
     * Acción para inscribir usuarios al grupo (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function userProcess(Request $request, $id)
    {
        $data = $request->validate([
            'user' => 'array'
        ]);

        if (!isset($data['user'])) {
            $data['user'] = [];
        }

        array_walk($data['user'], function(&$value){ $value = (int)$value; });

        $service = new $this->serviceClass();
        $serviceResponse = $service->currentUser($id, $data);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $id])
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.userView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }
}