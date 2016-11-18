<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;
use Carbon\Carbon;
use App\Bitacora;
use App\AtContrato;
use App\AtTermino;

class AtContratoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los contratos de la contrato que no han sido eliminados
            $contratos = AtContrato::orderBy('id','dsc')->get();
            // Se envian los contratos
            return Response::json($contratos, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los contrato de la contrato que no han sido eliminados
            $contrato = AtContrato::where('attermino_id', $id)->first();
            // Se envian los contrato
            return Response::json($contrato, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la contrato.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $contrato = AtContrato::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $contrato = new AtContrato;
                $accion = "Crear";
            }

            $partes = explode("-", Request::get('fecha_inicio'));

            $data['fecha_final'] = Carbon::create($partes[0],$partes[1],$partes[2])->addWeeks(Request::get('duracion'))->format('Y-m-d');
            
            // Se guardan los datos y se envia la respuesta
            if($contrato->guardar($data,$accion))
                return Response::json($contrato, 201);

            // Si hay errores de validacion se envian
            return Response::json($contrato->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al contrato y se elimina
            $contrato = AtContrato::find($id);
            $contrato->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el contrato eliminado
            return Response::json($contrato, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

}
