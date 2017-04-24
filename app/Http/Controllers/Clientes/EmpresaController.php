<?php

namespace App\Http\Controllers\Clientes;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Models\Cliente\Empresa;
use App\Models\Bitacora;

class EmpresaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los empresas de la empresa que no han sido eliminados
            $empresas = Empresa::orderBy('id','dsc')->with('municipio', 'empresarios')->get();
            // Se envian los empresas
            return Response::json($empresas, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los empresa de la empresa que no han sido eliminados
            $empresa = Empresa::where('id', $id)->with('empresarios', 'indicadores')->first();
            // Se envian los empresa
            return Response::json($empresa, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function search($txt) {
        try {
            // Se cargan todos los empresa de la empresa que no han sido eliminados
            $empresas = Empresa::where('nombre', 'like' ,'%' . $txt . '%')->get();
            // Se envian los empresas
            return Response::json($empresas, 200);
            
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
                $empresa = Empresa::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $empresa = new Empresa;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($empresa->guardar($data,$accion))
                return Response::json($empresa, 201);

            // Si hay errores de validacion se envian
            return Response::json($empresa->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al empresa y se elimina
            $empresa = Empresa::find($id);
            $empresa->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el empresa eliminado
            return Response::json($empresa, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }


    public function historial($id) {
        try {

            // Se cargan todos los empresa de la empresa que no han sido eliminados
            $empresa = Empresa::where('id', $id)->with('terminos','proyectos')->first();
            // $empresarios = $empresa->empresarios;

            // $eventos = [];
            // $capacitaciones = [];

            // dd($empresarios[0]->empresario()->nombre);
            // foreach ($empresarios as $cliente) {
            //    // foreach ($cliente->empresarios->eventos as $evento) {
            //    //    $eventos[] = $evento->evento;
            //    // }
            //    foreach ($cliente->empresario()->asistencias as $asistenciaCapacitacion) {
            //       // $capacitacion = $asistenciaCapacitacion->captermino;
            //       // $capacitacion['asistio'] = $asistenciaCapacitacion->asistio;
            //       // $capacitaciones[] = $capacitacion;
            //    }
            // }


            // dd($capacitaciones);
            // Se envian los empresa
            return Response::json($empresa, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

}
