<?php

namespace App\Models\At;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Consultor extends Model {

    use SoftDeletes;
    protected $table = 'atconsultores';
    public $errores;
    protected $fillable = array(
        'estado',
        'doc_oferta',
        'fecha_oferta',
        'fecha_seleccion',
        'attermino_id',
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
                    'tabla' => 11,
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
                'doc_oferta' => 'required',
                'fecha_oferta' => 'required',
                'fecha_seleccion' => 'required',
                'attermino_id' => 'required', 
                'consultor_id' => 'required'
            );
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }
        
        public function getConsultorAttribute(){
            return $this->consultor()->pluck('nombre')->first();
        }

        public function getTemaAttribute(){
            return $this->atTerminos()->pluck('tema')->first();
        }

        // public function getEmpresaAttribute(){
        //     $termino = $this->atTerminos()->with('empresa')->first();
        //     return $termino->empresa;
        // }

    /* RELACIÓN */
    
        public function atTerminos() 
        {
            return $this->belongsTo('App\Models\At\Termino','attermino_id');
        }
        public function consultor() 
        {
            return $this->belongsTo('App\Models\Consultor');
        }
        public function atContratos() 
        {
            return $this->hasmany('App\Models\At\Contrato','atconsultor_id');
        }

        public function ampliacionesContratos() 
        {
            return $this->hasmany('App\Models\At\Ampliacion','atconsultor_id');
        }

        public function actas() 
        {
            return $this->hasmany('App\Models\At\Acta','atconsultor_id');
        }

        

}