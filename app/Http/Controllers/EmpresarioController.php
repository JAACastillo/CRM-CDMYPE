<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Empresario;
use App\Bitacora;
use App\EmpresaEmpresario;

class EmpresarioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los empresarios de la empresa que no han sido eliminados
            $empresarios = Empresario::orderBy('id','dsc')->with('municipio','empresa')->get();
            // Se envian los empresarios
            return Response::json($empresarios, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los empresario de la empresa que no han sido eliminados
            $empresario = Empresario::where('id', $id)->with('empresa')->first();
            // Se envian los empresario
            return Response::json($empresario, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la empresario.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $empresario = Empresario::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $empresario = new Empresario;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($empresario->guardar($data,$accion))
                return Response::json($empresario, 201);

            // Si hay errores de validacion se envian
            return Response::json($empresario->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresario y se elimina
            $empresario = Empresario::find($id);
            $empresario->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el empresario eliminado
            return Response::json($empresario, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function empresa()
    {
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $data = Request::all();
            // return Response::json($data, 201);

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $empresaEmpresario = EmpresaEmpresario::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $empresaEmpresario = new EmpresaEmpresario;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($empresaEmpresario->guardar($data,$accion))
                return Response::json($empresaEmpresario, 201);

            // Si hay errores de validacion se envian
            return Response::json($empresaEmpresario->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
