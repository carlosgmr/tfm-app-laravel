<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Instructor\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->module = 'user';
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
            'questionarys' => [],
            'apiErrors' => [],
            'id' => $id,
            'validGroups' => [],
        ];

        $service = new \App\Library\Api\UserService();

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

        $responseQuestionnairesMade = $service->questionnairesMade($id);
        if ($responseQuestionnairesMade->isOk()) {
            //indexamos por grupo
            $items = $responseQuestionnairesMade->getData();
            $oldGroup = null;
            $currentGroup = null;

            foreach ($items as $item) {
                $currentGroup = $item['group']['id'];
                if ($currentGroup !== $oldGroup) {
                    $data['questionarys'][$currentGroup] = [];
                }

                $data['questionarys'][$currentGroup][] = $item;
                $oldGroup = $currentGroup;
            }
        } else {
            $data['apiErrors'] = array_merge($data['apiErrors'], $responseQuestionnairesMade->getListErrors());
        }

        return view($this->panel.'.'.$this->module.'.read', $data);
    }

    /**
     * Operación básica de lectura
     * @param Request $request
     * @param string|int $idUser
     * @param string|int $idQuestionary
     * @return mixed
     */
    public function questionaryDetails(Request $request, $idUser, $idQuestionary)
    {
        
    }
}