<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

use Auth;

class EventoEmpresarios extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'empresario_evento';
    public $errores;
    protected $fillable = ['evento_id', 'empresario_id', 'participacion'];
    protected $appends = ['empresario'];
    
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
                'evento_id'        => 'required',
                'empresario_id'   => 'required',
                'participacion'         => 'required'
            );
            
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes()) 
                return true;

            $this->errores = $validador->errors();
            return false;
        }


    /* Relaciones */

        public function getEmpresarioAttribute(){
           return $this->empresarios()->pluck('nombre')->first();
        }

        public function empresarios(){
            return $this->belongsTo('App\Empresario', 'empresario_id');
        }

        public function evento(){
            return $this->belongsTo('App\Evento');
        }
}