<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
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
        $service = new \App\Library\Api\UserService();
        $serviceResponse = $service->questionnairesByState(appUser('id'));
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
     * Operación para registrar las respuestas de un examen/encuesta (vista)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function doAttemptView(Request $request, $id)
    {
        $data = [
            'id' => $id,
            'item' => null,
            'apiErrors' => [],
        ];

        $service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->readBasic($id);

        if ($serviceResponse->isOk()) {
            $data['item'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
        }

        return view($this->panel.'.'.$this->module.'.doAttempt', $data);
    }

    /**
     * Operación para registrar las respuestas de un examen/encuesta (proceso)
     * @param Request $request
     * @param string|int $id
     * @return mixed
     */
    public function doAttemptProcess(Request $request, $id)
    {
        /*$data = $request->validate([
        ]);

        $service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->addQuestions($id, '{"questions":'.$data['questions'].'}');

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.read', ['id' => $id])
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }*/

        return redirect()->route($this->panel.'.'.$this->module.'.doAttempt', ['id' => $id])
                ->withInput($request->input())
                /*->withErrors($apiErrors)*/;
    }
}