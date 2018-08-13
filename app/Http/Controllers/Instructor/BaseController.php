<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /** @var string */
    protected $panel = 'instructor';
    /** @var string */
    protected $module;

    /**
     * Retorna un array con los ids de los grupos en los que está inscrito 
     * el instructor actual
     * @return array
     */
    protected function getInstructorGroups()
    {
        $idInstructor = appUser('id');
        $service = new \App\Library\Api\InstructorService();
        $serviceResponse = $service->listingGroup($idInstructor);
        $result = [];

        if ($serviceResponse->isOk()) {
            foreach ($serviceResponse->getData() as $group) {
                $result[] = $group['id'];
            }
        }

        return $result;
    }

    /**
     * Devuelve el listado de los grupos disponibles del instructor actual
     * @return array|null
     */
    protected function getGroups()
    {
        $result = null;
        $instructorService = new \App\Library\Api\InstructorService();
        $responseListingGroup = $instructorService->listingGroup(appUser('id'));
        if ($responseListingGroup->isOk()) {
            $result = $responseListingGroup->getData();
        }

        return $result;
    }

    /**
     * Retorna el listado de los modelos de examen disponibles
     * @return array|null
     */
    protected function getModels()
    {
        $result = null;
        $questionaryModelService = new \App\Library\Api\QuestionaryModelService();
        $responseListingModel = $questionaryModelService->listing();
        if ($responseListingModel->isOk()) {
            $result = $responseListingModel->getData();
        }

        return $result;
    }
}