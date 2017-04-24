<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

use Auth;

class Consultor extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'consultores';
    public $errores;
    protected $fillable = array(
        'nit',
        'dui',
        'correo',
        'nombre',
        'municipio_id',
        'direccion',
        'sexo',
        'telefono',
        'empresa',
        'iva',
        'celular'
    );    
    
    protected $appends = ['at', 'cap', 'paso'];
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
                // 'nit' => 'required|unique:consultores',
                'nombre' => 'required|max:100',
                // 'correo' => 'email|required|max:75|unique:consultores',
                // 'sexo' => 'required',
                // 'especialidad_id' => 'required'
            );
            
            // if ($this->exists) 
            // {
            //     $reglas['nit'] .= ',nit,' . $this->id;
            //     $reglas['correo'] .= ',correo,' . $this->id;
            // }
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes()) 
                return true;

            $this->errores = $validador->errors();
            return false;
        }

        public function getAtAttribute(){
            return $this->atConsultores()->where('estado','Seleccionado')->count();
        }

        public function getCapAttribute(){
            return $this->capConsultores()->where('estado','Seleccionado')->count();
        }

        public function getPasoAttribute(){

            if($this->cap > 0 || $this->at > 0)
                return 3;
            elseif($this->especialidades != '[]')
                return 2;

            return 2;

        }

    /* Relaciones */

        //
        public function capConsultores() 
        {
            return $this->hasMany('App\Models\Cap\Consultor', 'consultor_id');
        }

        public function atConsultores() 
        {
            return $this->hasMany('App\Models\At\Consultor', 'consultor_id');
        }

        public function especialidades() 
        {
            return $this->hasMany('App\Models\ConsultorEspecialidad', 'consultor_id');
        }

         public function municipio() 
        {
            return $this->belongsTo('App\Models\Municipio');
        }
}