<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Especialidad;
use App\Bitacora;

class EspecialidadController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los especialidades de la empresa que no han sido eliminados
            $especialidades = Especialidad::all();
            // Se envian los especialidades
            return Response::json($especialidades, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los especialidad de la especialidad que no han sido eliminados
            $especialidad = Especialidad::find($id);
            // Se envian los especialidad
            return Response::json($especialidad, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la especialidad.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $especialidad = Especialidad::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $especialidad = new Especialidad;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($especialidad->guardar($data,$accion))
                return Response::json($especialidad, 201);

            // Si hay errores de validacion se envian
            return Response::json($especialidad->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresa y se elimina
            $especialidad = Especialidad::find($id);
            $especialidad->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el especialidad eliminado
            return Response::json($especialidad, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }


}
