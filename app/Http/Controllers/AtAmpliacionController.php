<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;
use Carbon\Carbon;
use App\Bitacora;
use App\AtAmpliacion;
use App\AtTermino;

class AtAmpliacionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los atAmpliaciones de la atAmpliacion que no han sido eliminados
            $atAmpliaciones = AtAmpliacion::orderBy('id','dsc')->get();
            // Se envian los atAmpliaciones
            return Response::json($atAmpliaciones, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los atAmpliacion de la atAmpliacion que no han sido eliminados
            $atAmpliacion = AtAmpliacion::where('attermino_id', $id)->first();
            // Se envian los atAmpliacion
            return Response::json($atAmpliacion, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la atAmpliacion.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $atAmpliacion = AtAmpliacion::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $atAmpliacion = new AtAmpliacion;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($atAmpliacion->guardar($data,$accion))
                return Response::json($atAmpliacion, 201);

            // Si hay errores de validacion se envian
            return Response::json($atAmpliacion->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al atAmpliacion y se elimina
            $atAmpliacion = AtAmpliacion::find($id);
            $atAmpliacion->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el atAmpliacion eliminado
            return Response::json($atAmpliacion, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
