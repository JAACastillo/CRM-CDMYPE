<?php

namespace App\Http\Controllers;

use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\AtTermino;
use App\AtConsultor;

class ApiController extends Controller
{
  
    public function oferta(Request $request){
        try {

            // $data = Request::all();
            
            // Se reciben los datos y se asigna la empresa.
            $consultor = AtConsultor::find($request->id);
            $file = $request->oferta;
           
            // return $file;

            if($file)
            {
                // $ruta = base_path() . '/public/ofertas/';
                // $nombre = time().$file;
                // $file->move($ruta, $nombre);

                $request->oferta->storeAs('ofertas', 'filename.jpg');

                $consultor->doc_oferta = $file;
                $consultor->fecha_oferta = date("Y-m-d");
                $consultor->save();
            }
            
            return back();


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


}
