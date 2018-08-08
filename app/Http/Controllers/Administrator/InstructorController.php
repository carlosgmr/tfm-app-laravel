<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class InstructorController extends CrudController
{
    public function __construct()
    {
        $this->serviceClass = \App\Library\Api\InstructorService::class;
        $this->panel = 'administrator';
        $this->module = 'instructor';
        $this->rulesForCreate = [
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'surname_1' => 'required',
            'surname_2' => 'nullable',
            'active' => 'required',
        ];
        $this->rulesForUpdate = [
            'email' => 'required',
            'password' => 'nullable',
            'name' => 'required',
            'surname_1' => 'required',
            'surname_2' => 'nullable',
            'active' => 'required',
        ];
    }

    public function formatUpdateData($data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return $data;
    }

    public function read(Request $request, $id)
    {
        $data = [
            'item' => null,
            'groups' => [],
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

        $responseListingGroup = $service->listingGroup($id);
        if ($responseListingGroup->isOk()) {
            $data['groups'] = $responseListingGroup->getData();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingGroup->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.read', $data);
    }

    /**
     * Acción para inscribir al instructor en grupos (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function groupView(Request $request, $id)
    {
        $data = [
            'allGroups' => [],
            'currentGroups' => [],
            'apiErrors' => [],
            'id' => $id,
        ];

        $groupService = new \App\Library\Api\GroupService();
        $responseAllGroups = $groupService->listing();
        if ($responseAllGroups->isOk()) {
            $data['allGroups'] = $responseAllGroups->getData();
        } else {
            $data['apiErrors'] = $responseAllGroups->getListErrors();
        }

        $service = new $this->serviceClass();
        $responseCurrentGroups = $service->listingGroup($id);
        if ($responseCurrentGroups->isOk()) {
            foreach ($responseCurrentGroups->getData() as $group) {
                $data['currentGroups'][] = $group['id'];
            }
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseCurrentGroups->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.group', $data);
    }

    /**
     * Acción para inscribir al instructor en grupos (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function groupProcess(Request $request, $id)
    {
        $data = $request->validate([
            'group' => 'array'
        ]);

        if (!isset($data['group'])) {
            $data['group'] = [];
        }

        array_walk($data['group'], function(&$value){ $value = (int)$value; });

        $service = new $this->serviceClass();
        $serviceResponse = $service->currentGroup($id, $data);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $id])
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.groupView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }
}