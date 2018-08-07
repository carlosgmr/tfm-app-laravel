<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Clase base para los controladores de acciones CRUD
 */
class CrudController extends Controller
{
    /** @var string */
    protected $serviceClass;
    /** @var string */
    protected $panel;
    /** @var string */
    protected $module;
    /** @var array */
    protected $rulesForCreate;
    /** @var array */
    protected $rulesForUpdate;

    /**
     * Aplica un formato personalizado a los datos pasados
     * Si es necesario debe ser sobreescrito en las clases hijas
     * @param array $data
     * @return array
     */
    public function formatCreateData($data)
    {
        return $data;
    }

    /**
     * Aplica un formato personalizado a los datos pasados
     * Si es necesario debe ser sobreescrito en las clases hijas
     * @param array $data
     * @return array
     */
    public function formatUpdateData($data)
    {
        return $data;
    }

    /**
     * Operación básica de listado
     * @param Request $request
     * @return mixed
     */
    public function listing(Request $request)
    {
        $service = new $this->serviceClass();
        $serviceResponse = $service->listing();
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
        $service = new $this->serviceClass();
        $serviceResponse = $service->read($id);
        $data = [
            'item' => null,
            'apiErrors' => [],
            'id' => $id,
        ];

        if ($serviceResponse->isOk()) {
            $data['item'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
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
        return view($this->panel.'.'.$this->module.'.create');
    }

    /**
     * Operación básica de creación (proceso)
     * @param Request $request
     * @return mixed
     */
    public function createProcess(Request $request)
    {
        $data = $this->formatCreateData($request->validate($this->rulesForCreate));
        $service = new $this->serviceClass();
        $serviceResponse = $service->create($data);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.listing')
                    ->with('flashMessage', 'Registro creado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.createView')
                ->withInput($request->except('password'))
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
        $service = new $this->serviceClass();
        $serviceResponse = $service->read($id);
        $data = [
            'item' => null,
            'apiErrors' => [],
            'id' => $id,
        ];

        if ($serviceResponse->isOk()) {
            $data['item'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
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
        $data = $this->formatUpdateData($request->validate($this->rulesForUpdate));
        $service = new $this->serviceClass();
        $serviceResponse = $service->update($id, $data);

        if ($serviceResponse->isOk()) {
            return redirect()->route($this->panel.'.'.$this->module.'.listing')
                    ->with('flashMessage', 'Registro actualizado correctamente')
                    ->with('flashType', 'success');
        } else {
            $apiErrors = $serviceResponse->getListErrors();
        }

        return redirect()->route($this->panel.'.'.$this->module.'.updateView', ['id' => $id])
                ->withInput($request->except('password'))
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
        $service = new $this->serviceClass();
        $serviceResponse = $service->read($id);
        $data = [
            'item' => null,
            'apiErrors' => [],
            'id' => $id,
        ];

        if ($serviceResponse->isOk()) {
            $data['item'] = $serviceResponse->getData();
        } else {
            $data['apiErrors'] = $serviceResponse->getListErrors();
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
        $service = new $this->serviceClass();
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
}