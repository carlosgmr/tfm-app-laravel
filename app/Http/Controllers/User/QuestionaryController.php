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
        $service = new \App\Library\Api\QuestionaryService();
        $serviceResponse = $service->readBasic($id);

        if (!$serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.doAttemptView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors(['No se ha podido recuperar el listado de preguntas']);
        }

        $questions = $serviceResponse->getData()['questions'];
        $rules = [];
        $messages = [];

        foreach ($questions as $i => $question) {
            $rules['questionId'.($i+1)] = 'required';
            $rules['questionAnswer'.($i+1)] = 'required';
            $messages['questionId'.($i+1).'.required'] = 'La pregunta '.($i+1).' es obligatoria';
            $messages['questionAnswer'.($i+1).'.required'] = 'La respuesta a la pregunta '.($i+1).' es obligatoria';
        }

        $fields = $this->validate($request, $rules, $messages);
        $data = ['registries' => []];

        foreach ($questions as $i => $question) {
            $data['registries'][] = [
                'question' => $fields['questionId'.($i+1)] ?? null,
                'answer' => $fields['questionAnswer'.($i+1)] ?? null,
            ];
        }

        $registryService = new \App\Library\Api\RegistryService();
        $registryServiceResponse = $registryService->saveAttempt(appUser('id'), $id, $data);

        if ($registryServiceResponse->isOk()) {
            return redirect()->route('user.user.questionaryDetails', ['id' => $id])
                    ->with('flashMessage', 'Respuestas registradas correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $registryServiceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.doAttemptView', ['id' => $id])
                ->withInput($request->input())
                ->withErrors($apiErrors);
    }
}