<?php

namespace App\Http\Controllers;

use App\Models\Professional as ProfessionalModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $data = ProfessionalModel::with(['people'])->get();
            $message = $data->count()." ".($data->count() === 1 ? "profissional encontrado" : "profissionais encontrados")." com sucesso.";
            return $this->response($message, $data);
        } catch (\Exception $e) 
        {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                try
        {
            
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
            
        } catch (\Exception $e) 
        {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try
        {
            
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
            
        } catch (\Exception $e) 
        {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
