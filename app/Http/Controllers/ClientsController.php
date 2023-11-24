<?php

namespace App\Http\Controllers;

use App\Models\Client as ClientModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = ClientModel::with(['people'])->get();
            $message = $data->count().$data->count() === 1 ? 'cliente encontrado' : 'clientes encontrados'." com sucesso.";
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = ClientModel::with(['people'])->find($id);

            if(empty($data)) {
                return $this->response('Cliente não encontrado.', null, false, Response::HTTP_NOT_FOUND);
            }

            $message = "Cliente ".$data->people->name." encontrado com sucesso.";
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
