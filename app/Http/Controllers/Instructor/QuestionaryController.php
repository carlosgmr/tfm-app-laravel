<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Instructor\BaseController;
use Illuminate\Http\Request;

class QuestionaryController extends BaseController
{
    public function __construct()
    {
        $this->module = 'questionary';
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
            //'groups' => [],
            'apiErrors' => [],
            'id' => $id,
        ];

        $service = new \App\Library\Api\QuestionaryService();

        $responseRead = $service->read($id);
        if ($responseRead->isOk()) {
            $data['item'] = $responseRead->getData();
        } else {
            $data['apiErrors'] = $responseRead->getListErrors();
        }

        /*$responseListingGroup = $service->listingGroup($id);
        if ($responseListingGroup->isOk()) {
            $data['groups'] = $responseListingGroup->getData();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingGroup->getListErrors());
        }*/

        return view($this->panel.'.'.$this->module.'.read', $data);
    }

    /**
     * Operación básica de creación (vista)
     * @param Request $request
     * @return mixed
     */
    public function createView(Request $request)
    {
        $data = [
            'groups' => [],
            'models' => [],
            'apiErrors' => [],
        ];

        $instructorService = new \App\Library\Api\InstructorService();
        $responseListingGroup = $instructorService->listingGroup(appUser('id'));
        if ($responseListingGroup->isOk()) {
            $data['groups'] = $responseListingGroup->getData();
        } else {
            $data['apiErrors'] = $responseListingGroup->getListErrors();
        }

        $questionaryModelService = new \App\Library\Api\QuestionaryModelService();
        $responseListingModel = $questionaryModelService->listing();
        if ($responseListingModel->isOk()) {
            $data['models'] = $responseListingModel->getData();
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseListingModel->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.create', $data);
    }

    /**
     * Operación básica de creación (proceso)
     * @param Request $request
     * @return mixed
     */
    public function createProcess(Request $request)
    {
        $data = $request->validate([
            'group' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'model' => 'required',
            'public' => 'required',
            'active' => 'required',
        ]);
        $service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->create($data);

        if ($serviceResponse->isOk()) {
            $item = $serviceResponse->getData();
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $item['id']])
                    ->with('flashMessage', 'Registro creado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.createView')
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }
}