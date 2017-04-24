<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Bitacora;
use App\EventoEmpresarios;

class ParticipanteEventoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $eventoEmpresarios = EventoEmpresarios::orderBy('id','dsc')->get();
            // Se envian los empresas
            return Response::json($eventoEmpresarios, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $eventoEmpresario = EventoEmpresarios::where('id',$id)->first();
            // Se envian los empresas
            return Response::json($eventoEmpresario, 200);
            
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
                $eventoEmpresario = EventoEmpresarios::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $eventoEmpresario = new EventoEmpresarios;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($eventoEmpresario->guardar($data,$accion))
                return Response::json($eventoEmpresario, 201);

            // Si hay errores de validacion se envian
            return Response::json($eventoEmpresario->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresa y se elimina
            $eventoEmpresario = EventoEmpresarios::find($id);
            $eventoEmpresario->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el eventoEmpresario eliminado
            return Response::json($eventoEmpresario, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
