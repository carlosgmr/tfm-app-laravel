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
}