<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\CapTermino;

class CapacitacionesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los terminos de la empresa que no han sido eliminados
            $terminos = Captermino::orderBy('id','dsc')
                        ->with('contrato', 'consultor')
                        ->get();
                        
            // Se envian los terminos
            return Response::json($terminos, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }

    public function getBuscar($id) {
        try {
            // Se cargan todos los cliente de la empresa que no han sido eliminados
            $cliente = Captermino::find($id);
            // Se envian los cliente
            return Response::json($cliente, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }


    public function postGuardar()
    {
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $data = Request::all();
            $data['empresa_id'] = Auth::user()->empresa->id;

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id'))
                $cliente = Captermino::find(Request::get('id'));
            else
                $cliente = new Captermino;
            
            // Se guardan los datos y se envia la respuesta
            if($cliente->guardar($data))
                return Response::json($cliente, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

            // Si hay errores de validacion se envian
            return Response::json($cliente->errores->all(), 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }

    }

    public function postEliminar($id)
    {
        try{
            // Se busca al cliente y se elimina
            $cliente = Captermino::find($id);

            $cliente->delete();
            // Se retorna el cliente eliminado
            return Response::json($cliente, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }

    }

}
