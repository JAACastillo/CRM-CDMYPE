<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

use Auth;

class ConsultorEspecialidad extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'consultoresespecialidades';
    public $errores;
    protected $softDelete = true;
    protected $fillable = array(
        'consultor_id',
        'especialidad_id'
    );

     protected $appends = ['consultor', 'especialidad'];
    
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
                    'tabla' => 16,
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
                'consultor_id' => 'required',
                'especialidad_id' => 'required'
            );
            
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes()) 
                return true;

            $this->errores = $validador->errors();
            return false;
        }

        public function getConsultorAttribute(){
            return $this->consultor()->pluck('nombre')->first();;
        }

        public function getEspecialidadAttribute(){
            return $this->especialidad()->pluck('nombre')->first();;
        }

	/* Relaciones */

        //
        public function consultor() 
        {
            return $this->belongsTo('App\Consultor');
        }


        public function especialidad()
        {
            return $this->belongsTo('App\Especialidad');
        }
}