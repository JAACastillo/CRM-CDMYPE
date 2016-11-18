<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Usuario;
use App\Bitacora;

class UsuarioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los usuarios de la usuario que no han sido eliminados
            $usuarios = Usuario::orderBy('id','dsc')->get();
            // Se envian los usuarios
            return Response::json($usuarios, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los usuario de la usuario que no han sido eliminados
            $usuario = Usuario::where('id', $id)->first();
            // Se envian los usuario
            return Response::json($usuario, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function auth() {
        try {
            // Se cargan todos los usuario de la usuario que no han sido eliminados
            $usuario = Auth::user();
            // Se envian los usuario
            return Response::json($usuario, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la usuario.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $usuario = Usuario::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $usuario = new Usuario;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($usuario->guardar($data,$accion))
                return Response::json($usuario, 201);

            // Si hay errores de validacion se envian
            return Response::json($usuario->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al usuario y se elimina
            $usuario = Usuario::find($id);
            $usuario->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el usuario eliminado
            return Response::json($usuario, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }


}
