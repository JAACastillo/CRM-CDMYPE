<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Bitacora;
use App\Indicador;

class IndicadorController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function byEmpresa($id) {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $indicadores = Indicador::where('empresa_id', $id)->first();
            // Se envian los empresas
            return Response::json($indicadores, 200);
            
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
                $indicador = Indicador::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $indicador = new Indicador;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($indicador->guardar($data,$accion))
                return Response::json($indicador, 201);

            // Si hay errores de validacion se envian
            return Response::json($indicador->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresa y se elimina
            $empresaEmpresario = Indicador::find($id);
            $empresaEmpresario->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el empresaEmpresario eliminado
            return Response::json($empresaEmpresario, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
