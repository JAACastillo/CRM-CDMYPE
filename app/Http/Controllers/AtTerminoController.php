<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;

use App\AtTermino;
use App\AtConsultor;
use App\AtContrato;
use App\Acta;

class AtTerminoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los terminos de la empresa que no han sido eliminados
            $terminos = AtTermino::orderBy('id','dsc')
                        ->with('empresa','contrato', 'usuario', 'consultor')
                        ->get();
            // Se envian los terminos
            return Response::json($terminos, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }

    public function buscar($id) {
        try {
            // Se cargan todos los at de la empresa que no han sido eliminados
            $at = AtTermino::where('id',$id)->with('empresa','ampliacion')->first();
            // Se envian los at
            return Response::json($at, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }


    public function guardar()
    {
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $data = Request::all();

            // Si verifica si ya existe o si es nuevo
            if(Request::has('id')){
                $attermino = AtTermino::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $attermino = new AtTermino;
                $accion = "Crear";
                $attermino->estado = "Creado";
            }

            // Se guardan los datos y se envia la respuesta
            if($attermino->guardar($data,$accion))
                return Response::json($attermino, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

            // Si hay errores de validacion se envian
            return Response::json($attermino->errores->all(), 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al cliente y se elimina
            $cliente = AtTermino::find($id);

            $cliente->delete();
            // Se retorna el cliente eliminado
            return Response::json($cliente, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }

    }

    public function enviarTDR($consultores) {
        try {

            $consultores = Request::all();

            $banderaConsultor = 0;
            
            if ($consultores != []) {

                foreach ($consultores as $consultor) {
                    $consul = $at->consultores()
                            ->where('consultor_id', '=', $consultor);
                    // if()
                    // {
                        $consultorAT = new AtConsultor;
                        $consultorAT->attermino_id = $id;
                        $consultorAT->consultor_id = $consultor;
                        $tema = $at->tema;
                       
                       if( $this->mailOferta('emails.asistenciaTecnica', 
                                            $id, 
                                            $consultorAT->consultor->correo, 
                                            $consultorAT->consultor->nombre,
                                            $tema
                                        ) && !$consul->count() > 0
                        )
                        {
                            $consultorAT->save();
                        }
                        
                    // }
                    $banderaConsultor = 1;
                }
                if($banderaConsultor == 1)
                {
                    $at->estado = 2;
                    $at->save();
                }

                $id = Math::to_base($id + 100000, 62);
                return Redirect::route('atPasoOferta', $id);
            }
        Mail::send($template,array('id' => $id),function($message) use ($id, $email, $nombreConsultor, $tema) {
           
            $message->to($email, $nombreConsultor)
                    ->subject('TDR - ' . $tema);
        });
        return 1;      

            return Response::json($termino, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }

    public function enviados($id) {
        try {
            // Se cargan todos los cliente de la empresa que no han sido eliminados
            $cliente = AtConsultor::where('attermino_id', $id)->get();
            // Se envian los cliente
            return Response::json($cliente, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }


}
