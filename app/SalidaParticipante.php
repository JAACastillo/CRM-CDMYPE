<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

use Auth;

class SalidaParticipante extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'participantes';
    public $errores;
    protected $fillable = ['salida_id', 'participante_id'];
    protected $appends = ['participante'];   
    
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
                'salida_id'        => 'required',
                'participante_id'   => 'required'
            );
            
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes()) 
                return true;

            $this->errores = $validador->errors();
            return false;
        }


    /* Relaciones */

        public function getParticipanteAttribute(){
            return $this->participante()->pluck('nombre')->first();
        }

        public function participante(){
            return $this->belongsTo('App\User', 'participante_id');
        }
}