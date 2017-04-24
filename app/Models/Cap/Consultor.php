<?php

namespace App\Models\Cap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Consultor extends Model {

    use SoftDeletes;
    protected $table = 'capconsultores';
    public $errores;
    protected $fillable = array(
        'estado',
        'doc_oferta',
        'fecha_oferta',
        'fecha_seleccion',
        'captermino_id',
        'consultor_id'
    );
    
    protected $appends = ['consultor', 'tema'];
        

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
                    'tabla' => 19,
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
                'captermino_id' => 'required',
                'consultor_id' => 'required'
            );
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }

        public function getTemaAttribute(){
            return $this->capTerminos()->pluck('tema')->first();
        }
        
        public function getConsultorAttribute(){
            return $this->consultor()->pluck('nombre')->first();
        }

    /* Relaciones */

        
        public function capContratos() 
        {
            return $this->hasmany('App\Models\Cap\Contrato','capconsultor_id');
        }


        public function capTerminos() 
        {
            return $this->belongsTo('App\Models\Cap\Termino','captermino_id');
        }

        public function consultor() 
        {
            return $this->belongsTo('App\Models\Consultor');
        }

}