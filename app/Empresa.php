<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Auth;
use Carbon\Carbon;

class Empresa extends Model {

    use SoftDeletes;
    protected $table = 'empresas';
    public $errores;
    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'nombre',
        'categoria',
        'descripcion',
        'municipio_id',
        'direccion',
        'registro_iva',
        'constitucion',
        'clasificacion',
        'sector_economico',
        'actividad',
        'nit'
    );

    protected $appends = ['paso','municipio'];

    /* Validaciones */

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
                    'tabla' => 9,
                    'tabla_id' => $id,
                    'accion' => $accion
                );

                $bitacora->guardar($campos);
                return true;
            }

            return false;
        }


    /* Fin atributos personalizados */
        public function validar($datos)
        {
            $rules = array(
                'nombre' => 'required',
                // 'categoria'  => 'required',
                // 'descripcion'  => 'required',
                // 'direccion'  => 'required',
                // 'registro_iva'  => 'required',
                // 'constitucion'  => 'required',
                // 'clasificacion'  => 'required',
                // 'sector_economico'  => 'required',
                // 'actividad'  => 'required',
                // 'nit'  => 'required',
            );

            $validator = Validator::make($datos,$rules);

            if($validator->passes())
                return true;

            $this->errores = $validator->errors();
            return false;
        }

        /* Atributos personalizados */

        public function getPasoAttribute(){

            if($this->proyectos != '[]')
                return 5;
            elseif($this->indicador)
                return 4;
            elseif($this->empresarios != '[]')
                return 3;

            return 2;
        }

        // public function getPropietarioAttribute(){
        //     $id = $this->empresarios()->where('tipo', '=', 'Propietario')->pluck('empresario_id')->first();

        //     return Empresario::find($id);
        // }

        public function getMunicipioAttribute(){
            return $this->municipio()->pluck('nombre')->first();
        }


	/* Relaciones */

        public function terminos()
        {
            return $this->hasMany('App\AtTermino','empresa_id');
        }

        public function empresario()
        {
            return $this->hasOne('App\EmpresaEmpresario','empresa_id');
        }

        public function municipio()
        { 
            return $this->belongsTo('App\Municipio');
        }

        public function indicadores(){
            return $this->hasOne('App\Indicador', 'empresa_id');
        }

        public function proyectos(){
            return $this->hasMany('App\proyecto', 'empresa_id');
        }
}
