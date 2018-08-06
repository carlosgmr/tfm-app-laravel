<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Api\AdministratorService;

class AdministratorController extends Controller
{
    public function listing(Request $request)
    {
        $administratorService = new AdministratorService();
        $serviceResponse = $administratorService->listing();
        $data = [
            'items' => [],
            'apiErrors' => [],
        ];

        if ($serviceResponse->isOk()) {
            $data['items'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
        }

        return view('administrator.administrator.listing', $data);
    }

    public function read(Request $request, $id)
    {
        $administratorService = new AdministratorService();
        $serviceResponse = $administratorService->read($id);
        $data = [
            'item' => null,
            'apiErrors' => [],
        ];

        if ($serviceResponse->isOk()) {
            $data['item'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
        }

        return view('administrator.administrator.read', $data);
    }

    public function createView(Request $request)
    {
        return view('administrator.administrator.create');
    }

    public function createProcess(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'surname_1' => 'required',
            'surname_2' => 'nullable',
            'active' => 'required',
        ]);

        $administratorService = new AdministratorService();
        $serviceResponse = $administratorService->create($data);

        if ($serviceResponse->isOk()) {
            return redirect()->route('administrator.administrator.listing')
                    ->with('flashMessage', 'El administrador ha sido creado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route('administrator.administrator.createView')
                ->withInput($request->except('password'))
                ->withErrors($apiErrors);
    }

    public function updateView(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function updateProcess(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function deleteView(Request $request, $id)
    {
        return view('administrator.home');
    }

    public function deleteProcess(Request $request, $id)
    {
        return view('administrator.home');
    }
}