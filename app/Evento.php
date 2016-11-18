<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

use Auth;

class Evento extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'eventos';
    public $errores;
    protected $fillable = ['nombre', 'descripcion', 'fecha', 'lugar', 'tipo'];
	protected $appends = ['participantes'];   
    
    /* Guardar */

        public function guardar($datos,$accion) 
        {
            if($this->validar($datos)) 
            {
                $this->fill($datos);
                $this->save();

                $id = $this->id;
                $bitacora = new Bitacora;
                $campos = array(
                    'usuario_id' => Auth::user()->id,
                    'tabla' => 15,
                    'tabla_id' => $id,
                    'accion' => $accion
                );
                
                $bitacora->guardar($campos);
                return true;
            }

            return false;
        }


    /* Validaciones */

        public function validar($datos) 
        {        
            $reglas = array(
                'nombre' 		=> 'required',
                'descripcion' 	=> 'required',
                'fecha'			=> 'required',
                'lugar'			=> 'required',
                'tipo'			=> 'required'
            );
            
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes()) 
                return true;

            $this->errores = $validador->errors();
            return false;
        }


    /* Relaciones */

        public function getParticipantesAttribute(){
        	return $this->participantes()->count();
        }

        public function participantes(){
        	return $this->hasMany('App\EventoEmpresarios');
        }
}