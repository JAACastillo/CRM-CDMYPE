<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Bitacora;
use App\EmpresaEmpresario;

class EmpresaEmpresarioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function byEmpresa($id) {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $empresaEmpresarios = EmpresaEmpresario::where('empresa_id', $id)->with('empresario')->get();
            // Se envian los empresas
            return Response::json($empresaEmpresarios, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function byEmpresario($id) {
        try {
            // Se cargan todos los empresa de la empresa que no han sido eliminados
            $empresaEmpresarios = EmpresaEmpresario::where('empresario_id', $id)->with('empresa')->get();
            // Se envian los empresa
            return Response::json($empresaEmpresarios, 200);
            
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
                $empresaEmpresarios = EmpresaEmpresario::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $empresaEmpresarios = new EmpresaEmpresario;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($empresaEmpresarios->guardar($data,$accion))
                return Response::json($empresaEmpresarios, 201);

            // Si hay errores de validacion se envian
            return Response::json($empresaEmpresarios->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresa y se elimina
            $empresaEmpresario = EmpresaEmpresario::find($id);
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
