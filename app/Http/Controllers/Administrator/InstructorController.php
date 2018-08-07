<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\CrudController;

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
}