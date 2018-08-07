<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\CrudController;

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
}