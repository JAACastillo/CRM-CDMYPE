<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Models\Consultor;
use App\Models\Bitacora;
use App\Models\ConsultorEspecialidad;

class ConsultorController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los consultores de la empresa que no han sido eliminados
            $consultores = Consultor::orderBy('id','dsc')->with('municipio','especialidades')->get();
            // Se envian los consultores
            return Response::json($consultores, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los consultor de la empresa que no han sido eliminados
            $consultor = Consultor::where('id',$id)->with('municipio','especialidades', 'atConsultores', 'capConsultores')->first();
            // Se envian los consultor
            return Response::json($consultor, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function byespecialidad($especialidad) {
        try {
            // Se cargan todos los consultor de la empresa que no han sido eliminados
            $consultor = ConsultorEspecialidad::where('especialidad_id',$especialidad)->get();
            // Se envian los consultor
            return Response::json($consultor, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la consultor.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $consultor = Consultor::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $consultor = new Consultor;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($consultor->guardar($data,$accion))
                return Response::json($consultor, 201);

            // Si hay errores de validacion se envian
            return Response::json($consultor->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al consultor y se elimina
            $consultor = Consultor::find($id);
            $consultor->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el consultor eliminado
            return Response::json($consultor, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function agregarespecilidad()
    {
        try {
            
            // Se reciben los datos y se asigna la especialidad.
            $data = Request::all();

            $especialidad = new ConsultorEspecialidad;
            $accion = "Crear";
            
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

    public function quitarespecilidad($id)
    {
        try{
            // Se busca al especialidad y se elimina
            $especialidad = ConsultorEspecialidad::find($id);
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
