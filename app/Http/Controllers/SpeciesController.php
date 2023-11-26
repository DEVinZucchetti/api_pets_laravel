<?php

namespace App\Http\Controllers;

use App\Models\Specie as SpecieModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try 
        {
            $data = SpecieModel::get();
            $message = $data->count().($data->count() === 1 ? ' Especie encontrada' : ' Especies encontradas')." com sucesso.";
            return $this->response($message, $data);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = ['name' => 'required | string | min: 3 | max: 50'];
            $request->validate($validator);
            $data = SpecieModel::create($request->all());

            return $this->response("Especie ".$data->name." cadastrada com sucesso.", $data);

        } catch (\Exception $e)
        {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try 
        {
            $data = SpecieModel::find($id);

            if(empty($data)) {
                return $this->response('Especie não encontrada.', null, false, Response::HTTP_NOT_FOUND);
            }

            $message = "Especie ".$data->name." encontrada com sucesso.";
            return $this->response($message, $data);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = ['name' => ' string | min: 3 | max: 50'];

            $request->validate($validator);

            $data = SpecieModel::find($id);

            if(empty($data)) {
                return $this->response('Especie não encontrada.', null, false, Response::HTTP_NOT_FOUND);
            }

            $data->update($request->all());

            return $this->response("Especie ".$data->name." atualizada com sucesso.", $data);

        } catch (\Exception $e)
        {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try 
        {
            $data = SpecieModel::find($id);

            if(empty($data)) {
                return $this->response('Especie não encontrada.', null, false, Response::HTTP_NOT_FOUND);
            }

            SpecieModel::destroy($data->id);

            $message = "Especie ".$data->name." deletada com sucesso.";
            return $this->response($message, $data);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
