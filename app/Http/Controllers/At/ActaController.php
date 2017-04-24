<?php

namespace App\Http\Controllers\At;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Acta;
use App\Bitacora;
use App\AtTermino;

class ActaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los actas de la acta que no han sido eliminados
            $actas = Acta::orderBy('id','dsc')->get();
            // Se envian los actas
            return Response::json($actas, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los acta de la acta que no han sido eliminados
            $acta = Acta::where('attermino_id', $id)->first();
            // Se envian los acta
            return Response::json($acta, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la acta.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $acta = Acta::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $acta = new Acta;
                $accion = "Crear";
            }

            $at = AtTermino::find($data['attermino_id']);
            $at->estado = "Finalizada";
            $at->save();
            
            // Se guardan los datos y se envia la respuesta
            if($acta->guardar($data,$accion))
                return Response::json($acta, 201);

            // Si hay errores de validacion se envian
            return Response::json($acta->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al acta y se elimina
            $acta = Acta::find($id);
            $acta->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el acta eliminado
            return Response::json($acta, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
