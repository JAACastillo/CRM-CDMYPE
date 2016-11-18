<?php

namespace App\Http\Controllers;



use Response;
use Request;
use Auth;
use File;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

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
            $at = AtTermino::where('id',$id)->with('empresa','empresario','consultor', 'consultores', 'ofertantes','contrato', 'ampliacion', 'acta' )->first();
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
            $data['usuario_id'] = Auth::user()->id;

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
            // Se busca al attermino y se elimina
            $attermino = AtTermino::find($id);

            $attermino->delete();
            // Se retorna el attermino eliminado
            return Response::json($attermino, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }

    }

    public function enviarTDR() {
        try {

            $consultores = Request::all();
            $no = 0;
            $si = 0;
            $banderaConsultor = 0;
            $at = AtTermino::find($consultores[0]['attermino_id']);
            
            if ($consultores != []) {

                foreach ($consultores as $consultor) {
                    if ($consultor['enviar'] == 1) {

                        $c = AtConsultor::where('attermino_id', $at->id)->where('consultor_id', $consultor['consultor_id'])->get();
                        if ($c == '[]') {
                            $consultorAT = new AtConsultor;
                            $consultorAT->attermino_id = $consultor['attermino_id'];
                            $consultorAT->consultor_id = $consultor['consultor_id'];
                        }else{
                            $consultorAT = AtConsultor::find($consultor['consultor_id']);
                        }
                    
                        if ($this->correo($at, $consultor)){
                            $si+=1;
                            $consultorAT->save();
                        }
                        else{ $no+=1;}
                    }

                    $banderaConsultor = 1;
                }

                if($banderaConsultor == 1)
                {
                    $at->estado = "Enviado";
                    $at->save();
                }
            }

            return Response::json($si, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }

    public function correo($at, $consultor){
        try {
            Mail::send('emails.tdr', ['at' => $at, 'consultor' => $consultor], function ($m) use ($at, $consultor) {
                $m->to($consultor['correo'], $consultor['consultor'])
                  ->subject('TDR - ' . $at->tema);
            });
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function enviados($id) {
        try {
            // Se cargan todos los attermino de la empresa que no han sido eliminados
            $attermino = AtConsultor::where('attermino_id', $id)->get();
            // Se envian los attermino
            return Response::json($attermino, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }

    public function oferta(){
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $consultor = AtConsultor::find(Input::get('id'));
            $file = Input::file('file');

            if($file)
            {
                $ruta = base_path() . '/public/ofertas/';
                $nombre = time().$file->getClientOriginalName();
                $file->move($ruta, $nombre);
                $consultor->doc_oferta = $nombre;
                $consultor->fecha_oferta = date("Y-m-d");
                $consultor->save();
            }
            
            return Response::json($consultor, 201);


        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    
    public function quitaroferta(){
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $consultor = AtConsultor::find(Input::get('id'));
            $consultor->doc_oferta = "";
            $consultor->save();
            
            return Response::json($consultor, 201);


        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

    public function consultor(){
       try {
           
           $data = Request::all();

           $at = AtTermino::find($data['attermino_id']);
           $consultores = $at->consultores;
           $consultorSeleccionado = [];

           foreach ($consultores as $con) {
               if ($con->id == $data['id']) {
                    $consultorSeleccionado = AtConsultor::find($con->id);
                    $consultorSeleccionado->estado = 'Seleccionado';
                    $consultorSeleccionado->save();
               }else{
                    $consultor = AtConsultor::find($con->id);
                    $consultor->estado = 'Enviado';
                    $consultor->save();
               }
           }
           
           return Response::json($consultorSeleccionado, 201);


       } catch (Exception $e) {
           // Si hay error de servidor se envia el error
           return Response::json($e, 500);
       } 
    }


}
