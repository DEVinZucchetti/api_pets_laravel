<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(){
        return 'ola laravel';
    }

    public function store(Request $request){

        $data = $request->all();

        $name = $request->input('name');

    }
}
