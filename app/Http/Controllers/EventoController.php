<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Bitacora;
use App\Evento;

class EventoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $eventos = Evento::orderBy('id','dsc')->get();
            // Se envian los empresas
            return Response::json($eventos, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $evento = Evento::where('id',$id)->with('participantes')->first();
            // Se envian los empresas
            return Response::json($evento, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $evento = Evento::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $evento = new Evento;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($evento->guardar($data,$accion))
                return Response::json($evento, 201);

            // Si hay errores de validacion se envian
            return Response::json($evento->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresa y se elimina
            $evento = Evento::find($id);
            $evento->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el evento eliminado
            return Response::json($evento, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
