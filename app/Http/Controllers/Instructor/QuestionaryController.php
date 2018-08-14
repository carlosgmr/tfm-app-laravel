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
     * Operación básica de listado
     * @param Request $request
     * @return mixed
     */
    public function listing(Request $request)
    {
        $service = new \App\Library\Api\InstructorService();
        $serviceResponse = $service->listingQuestionary(appUser('id'));
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
            'apiErrors' => [],
            'id' => $id,
        ];

        $service = new \App\Library\Api\QuestionaryService();

        $responseRead = $service->readComplete($id);
        if ($responseRead->isOk()) {
            $data['item'] = $responseRead->getData();
        } else {
            $data['apiErrors'] = $responseRead->getListErrors();
        }

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

        $groups = $this->getGroups();
        if (is_array($groups)) {
            $data['groups'] = $groups;
        } else {
            $data['apiErrors'][] = 'No se ha podido cargar los grupos disponibles';
        }

        $models = $this->getQuestionaryModels();
        if (is_array($models)) {
            $data['models'] = $models;
        } else {
            $data['apiErrors'][] = 'No se ha podido cargar los tipos de examen';
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

    /**
     * Operación básica de actualización (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function updateView(Request $request, $id)
    {
        $data = [
            'item' => null,
            'apiErrors' => [],
            'id' => $id,
        ];

        $questionaryService = new \App\Library\Api\QuestionaryService();
        $readResponse = $questionaryService->read($id);

        if ($readResponse->isOk()) {
            $data['item'] = $readResponse->getData();
        } else {
            $data['apiErrors'] = $readResponse->getListErrors();
        }

        return view($this->panel.'.'.$this->module.'.update', $data);
    }

    /**
     * Operación básica de actualización (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function updateProcess(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'public' => 'required',
            'active' => 'required',
        ]);
        $service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->update($id, $data);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $id])
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.updateView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }

    /**
     * Operación básica de eliminación (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function deleteView(Request $request, $id)
    {
        $data = [
            'item' => null,
            'group' => null,
            'model' => null,
            'apiErrors' => [],
            'id' => $id,
        ];

        $service = new \App\Library\Api\QuestionaryService();

        $responseRead = $service->read($id);
        if ($responseRead->isOk()) {
            $data['item'] = $responseRead->getData();
            $data['group'] = $this->getGroup($data['item']['group']);
            $data['model'] = $this->getQuestionaryModel($data['item']['model']);
        } else {
            $data['apiErrors'] = $responseRead->getListErrors();
        }

        return view($this->panel.'.'.$this->module.'.delete', $data);
    }

    /**
     * Operación básica de eliminación (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function deleteProcess(Request $request, $id)
    {
        $service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->delete($id);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.listing')
                    ->with('flashMessage', 'Registro eliminado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.deleteView', ['id' => $id])
                ->withErrors($apiErrors);
    }

    /**
     * Operación para actualizar las preguntas y respuestas de un 
     * examen/encuesta (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function updateQuestionsView(Request $request, $id)
    {
        $data = [
            'id' => $id,
            'models' => $this->getQuestionsModels(),
            'apiErrors' => [],
        ];

        return view($this->panel.'.'.$this->module.'.updateQuestions', $data);
    }

    /**
     * Operación para actualizar las preguntas y respuestas de un 
     * examen/encuesta (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function updateQuestionsProcess(Request $request, $id)
    {
        $data = $request->validate([
            'questions' => 'required|json',
        ]);

        $apiErrors = [];
        $questions = json_decode($data['questions'], true);
        if (count($questions) < 4) {
            $apiErrors[] = 'Debes añadir mínimo 4 preguntas';
        }

        if (empty($apiErrors)) {
        /*$service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->update($id, $data);

        if ($serviceResponse->isOk()) {*/
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $id])
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        /*} else {
            $apiErrors = $serviceResponse->getListErrors();
        }*/
        }

        return redirect()->route($this->panel.'.'.$this->module.'.updateQuestionsView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }
}