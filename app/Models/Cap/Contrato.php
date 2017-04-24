<?php

namespace App\Models\Cap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Contrato extends Model {

    use SoftDeletes;
    
    protected $table = 'capcontratos';    
    public $errores;
    protected $fillable = array(
        'pago',
        'lugar_firma',
        'firma',
        'captermino_id'
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
                    'tabla' => 21,
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
                'pago' => 'required',
                'lugar_firma' => 'required',
                'firma' => 'required',
                'captermino_id' => 'required'
            );
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }
        

     /* Relaciones */
 
        public function capConsultores()
        {
            return $this->belongsTo('App\Models\Cap\Consultor','capconsultor_id');
        }
        public function terminos() 
        {
            return $this->belongsTo('App\Models\Cap\Termino','captermino_id');
        }

}