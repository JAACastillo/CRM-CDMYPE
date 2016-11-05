<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;
use Auth;

class Acta extends Model {

    use SoftDeletes;

    protected $table = 'actas';
    public $errores;
    protected $fillable = array(
        'estado',
        'fecha',
        'attermino_id'
    );
    
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
                    'tabla' => 13,
                    'tabla_id' => $id,
                    'accion' => $accion
                );
                
                $bitacora->guardar($campos);
                return true;
            }
            return false;
        }

    /* Validación de Campos */

        public function validar($datos) 
        {
            $reglas = array(
                'estado' => 'required',
                'fecha' => 'required',
                'attermino_id' => 'required'
            );
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }

    /* Relaciones */

        public function atConsultores() 
        {
            return $this->belongsTo('App\AtConsultor','atconsultor_id');
        }
        
}