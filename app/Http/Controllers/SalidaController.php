<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\Salida;
use App\Bitacora;

class SalidaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los salidas de la salida que no han sido eliminados
            $salidas = Salida::orderBy('id','dsc')->get();
            // Se envian los salidas
            return Response::json($salidas, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los salida de la salida que no han sido eliminados
            $salida = Salida::where('id', $id)->with('participantes')->first();
            // Se envian los salida
            return Response::json($salida, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la salida.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $salida = Salida::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $salida = new Salida;
                $accion = "Crear";
            }
            
            // Se guardan los datos y se envia la respuesta
            if($salida->guardar($data,$accion))
                return Response::json($salida, 201);

            // Si hay errores de validacion se envian
            return Response::json($salida->errores->all(), 200);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al salida y se elimina
            $salida = Salida::find($id);
            $salida->delete();

            $bitacora = new Bitacora;
            $campos = array('usuario_id' => Auth::user()->id, 'tabla' => 9, 'tabla_id' => $id, 'accion' => 'Eliminar' );
            $bitacora->guardar($campos);

            // Se retorna el salida eliminado
            return Response::json($salida, 201);

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }

    }


}



    // public function create()
    // {
    //     $salida = new Salida;
    //     $asesores = User::all()->lists('nombre', 'id');
    //     date_default_timezone_set('America/El_Salvador');
    //     $hoy = date("Y-m-d");                       // 10, 3, 2001
    //     $hora = date("H:i");                         // 17:16:18

    //     $municipios = array('' => 'Seleccione una opción') + Municipio::all()->lists('municipio', 'id');
    //     $salida->fecha_inicio = $hoy;
    //     $salida->fecha_final = $hoy;
    //     $salida->hora_salida = "08:30";//$hora;
    //     $salida->hora_regreso = "16:00";//$hora;
    //     $salida->participantes = [2,3,4,5,6,7,8,12];
    //     $salida->objetivo = "Brindar los servicios de asesoría a nuevos clientes que les permita mejorar sus salidas orientadas a la generación de impacto económico";
    //     $salida->justificacion = "Debido a las grandes distancias que hay entre la Universidad y los lugares donde están establecidas las salidas se dificulta que estos puedan visitar el centro por tal razón existe la necesidad de realizar visitas a estos";

    //     return View::make('salidas.create', compact('salida', 'asesores', 'municipios'));
    // }


    // public function store()
    // {
    //     $data = Input::only('observacion','fecha_inicio','hora_salida','hora_regreso','lugar_destino','justificacion','objetivo','encargado');
    //     $participantes = Input::get('participantes');
    //     $salida = new Salida;

    //     if($salida->guardar($data, 1)){
    //         foreach($participantes as $participante) {
    //          $partic = new Participante();
    //          $partic->participante_id = $participante;
    //          $partic->salida_id = $salida->id;
    //          $partic->save();
    //         }
    //         return Redirect::to('salidas');
    //     }

    //     return Redirect::back()
    //                     ->withErrors($salida->errores)
    //                     ->withInput();
    // }

   
    // public function pdf()
    // {
    //     $ano = Input::get('ano');
    //     $mes = Input::get('mes');
    //     $firma = Input::get('firma');

    //     $salidas = Salida::whereRaw('YEAR(fecha_inicio) = ? and MONTH(fecha_inicio) = ?', [$ano, $mes])
    //                         ->orderBy('fecha_inicio', 'ASC')
    //                         ->get();

    //   $pdf = App::make('dompdf');
    //   $pdf->loadView('pdf.salidas', compact('salidas', 'ano', 'mes', 'firma'))->setOrientation('landscape');;

    //   return $pdf->stream();
    // }

    // //Actualizar las especialidades
    // public function actualizarParticipantes($idSalida,$salida_participantes){

    //     //Sacamos todos los participantes
    //     $participantes = Participante::where('salida_id', '=', $idSalida)->get();
    //     //Las eliminamos
    //     foreach ($participantes as $item) {
    //         $parti = Participante::find($item->id);
    //         $parti->delete();
    //     }
    //     //Ingresamos las nuevos
    //     foreach($salida_participantes as $item) {
    //             $part = new Participante;
    //             $part->participante_id = $item;
    //             $part->salida_id = $idSalida;
    //             $part->save();
    //     }

    //     return true;
    // }

// }
