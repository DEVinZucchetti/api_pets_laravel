<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\People as PeopleModel;

class PeoplesController extends Controller
{
    public function index()
    {
        try {
            $peoples = PeopleModel::all();
            $message = $peoples->count()." ".($peoples->count() === 1 ? "pessoa encontrada" : "pessoas encontradas")." com sucesso.";
            return $this->response($message, $peoples);
        } catch(\Exception $e) {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
