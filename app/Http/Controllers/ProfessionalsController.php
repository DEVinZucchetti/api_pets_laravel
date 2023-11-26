<?php

namespace App\Http\Controllers;

use App\Models\Professional as ProfessionalModel;
use App\Models\People as PeopleModel;
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
            $request->validate([
                'name' => 'required | min: 3 | max: 150',
                'cpf' => 'min: 11 | max: 20',
                'contact' => 'max: 20',
                'specialty'=> 'required | string | max: 50',
                'register'=> ' string | max: 20',
            ]);

            $people = PeopleModel::firstOrCreate($request->only(['name', 'cpf', 'contact']));

            $data = ProfessionalModel::firstOrCreate([
                'people_id'=> $people->id,
                'specialty'=> $request->input('specialty'),
                'register'=> $request->input('register'),
            ]);

            return $this->response("Profissional ".$data->people->name." cadastrado com sucesso.", $data);
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
            $data = ProfessionalModel::with(['people'])->find($id);

            if(empty($data))
            {
                return $this->response("Profissional não encontrado.", null, false, Response::HTTP_NOT_FOUND);
            }
            
            return $this->response("Profissional ".$data->people->name." encontrado com sucesso.", $data);
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
            $request->validate([
                'name' => 'string | min: 3 | max: 150',
                'cpf' => 'string | min: 11 | max: 20',
                'contact' => 'string | max: 20',
                'specialty'=> 'required | string | max: 50',
                'register'=> ' string | max: 20',
            ]);

            $professional = ProfessionalModel::find($id);
            $professional->update([
                'specialty'=> $request->input('specialty'),
                'register'=> $request->input('register'),
            ]);

            $people = PeopleModel::find($professional->people->id);

            if(!empty($request->input('name'))) {
                $people->name = $request->name;
                $people->save();
            }

            if(!empty($request->input('cpf'))) {
                $people->cpf = $request->cpf;
                $people->save();
            }

            if(!empty($request->input('contact'))) {
                $people->contact = $request->contact;
                $people->save();
            }

            $data = ProfessionalModel::with(['people'])->find($id);


            return $this->response("Profissional ".$data->people->name." atualizado com sucesso.", $data);
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
            $data = ProfessionalModel::with(['people'])->find($id);

            if(empty($data))
            {
                return $this->response("Profissional não encontrado.", null, false, Response::HTTP_NOT_FOUND);
            }
            
            ProfessionalModel::destroy($data->id);
            return $this->response("Profissional ".$data->people->name." deletado com sucesso.", $data);
        } catch (\Exception $e) 
        {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
