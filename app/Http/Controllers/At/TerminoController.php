<?php

namespace App\Http\Controllers\At;

use Response;
use Request;
use Auth;
use File;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Models\At\Termino;
use App\Models\At\Consultor;
use App\Models\At\Contrato;
use App\Models\At\Acta;

class TerminoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los terminos de la empresa que no han sido eliminados
            $terminos = Termino::orderBy('id','dsc')
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
            $at = Termino::where('id',$id)->with('empresa','empresario','consultor', 'consultores', 'ofertantes','contrato', 'ampliacion', 'acta' )->first();
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
                $termino = Termino::find(Request::get('id'));
                $accion = "Modificar";
            }
            else{
                $termino = new Termino;
                $accion = "Crear";
                $termino->estado = "Creado";
            }

            // Se guardan los datos y se envia la respuesta
            if($termino->guardar($data,$accion))
                return Response::json($termino, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

            // Si hay errores de validacion se envian
            return Response::json($termino->errores->all(), 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }

    }

    public function eliminar($id)
    {
        try{
            // Se busca al termino y se elimina
            $termino = Termino::find($id);

            $termino->delete();
            // Se retorna el termino eliminado
            return Response::json($termino, 201, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));

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
            $at = Termino::find($consultores[0]['termino_id']);
            
            if ($consultores != []) {

                foreach ($consultores as $consultor) {
                    if ($consultor['enviar'] == 1) {

                        $c = Consultor::where('termino_id', $at->id)->where('consultor_id', $consultor['consultor_id'])->get();
                        if ($c == '[]') {
                            $consultorAT = new Consultor;
                            $consultorAT->termino_id = $consultor['termino_id'];
                            $consultorAT->consultor_id = $consultor['consultor_id'];
                        }else{
                            $consultorAT = Consultor::find($consultor['consultor_id']);
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
            // Se cargan todos los termino de la empresa que no han sido eliminados
            $termino = Consultor::where('termino_id', $id)->get();
            // Se envian los termino
            return Response::json($termino, 200, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500, array('content-type' => 'application/json', 'Access-Control-Allow-Origin' => '*'));
        }
    }

    public function oferta(){
        try {
            
            // Se reciben los datos y se asigna la empresa.
            $consultor = Consultor::find(Input::get('id'));
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
            $consultor = Consultor::find(Input::get('id'));
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

           $at = Termino::find($data['termino_id']);
           $consultores = $at->consultores;
           $consultorSeleccionado = [];

           foreach ($consultores as $con) {
               if ($con->id == $data['id']) {
                    $consultorSeleccionado = Consultor::find($con->id);
                    $consultorSeleccionado->estado = 'Seleccionado';
                    $consultorSeleccionado->save();
               }else{
                    $consultor = Consultor::find($con->id);
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
