<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;
use Auth;

class AtTermino extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'atterminos';
    protected $fillable = array(
        'tema', 'obj_general', 'obj_especifico', 'productos',
        'tiempo_ejecucion', 'trabajo_local', 'fecha', 'financiamiento',
        'aporte', 'estado', 'especialidad_id', 'usuario_id',
        'empresa_id', 'empresario_id', 'informe'
    );


    protected $appends = ['especialidad', 'paso', 'asesor'];
    
    /* Guardar */

     public function guardar($datos,$accion)
        {
            $date = strtotime($datos['fecha']);

            $datos['fecha'] = date('Y-m-d', $date);
            if($this->validar($datos))
            {
                $this->fill($datos);
                $this->save();
                $id = $this->id;
                $bitacora = new Bitacora;

                $campos = array(
                    'usuario_id' => Auth::user()->id,
                    'tabla' => 10,
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
                'tema' => 'required|max:500',
                'obj_general' => 'required|max:500',
                'obj_especifico' => 'required',
                'productos' => 'required',
                'tiempo_ejecucion' => 'numeric|required',
                'trabajo_local' => 'numeric|required',
                'fecha' => 'required',
                'financiamiento' => 'required',
                'aporte' => 'required',
                'especialidad_id' => 'required',
                'usuario_id' => 'required',
                'empresa_id' => 'required',
                'empresario_id' => 'required'
            );

            $validador = Validator::make($datos,$reglas);

            if($validador->passes())
                return true;

            $this->errores = $validador->errors();

            return false;
        }



        public function getOfertantesAttribute()
        {

            return $this->consultores()
                        ->where("doc_oferta", "!=", "")
                        ->get();
            //Return "Ofertantes";
        }


        public function getPasoAttribute(){
            switch ($this->estado) {
            case 'Creado':
                return 3;
                break;
            case 'Enviado':
                return 4;
                break;
            case 'Ofertas Recibidas':
                return 5;
                break;
            case 'Consultor Seleccionado':
                return 6;
                break;
            case 'Contratada':
                return 7;
                break;
            case 'Finalizada':
                return 8;
                break;
            default:

                return 8;

                break;
            }

        }

        public function getEspecialidadAttribute(){
            return $this->especialidad()->pluck('nombre')->first();
        }

        public function getAsesorAttribute(){
            return $this->usuario()->pluck('nombre')->first();
        }

    /* Relaciones */

        //
        public function usuario()
        {
            return $this->belongsTo('App\User');
        }

        public function empresa()
        {
            return $this->belongsTo('App\Empresa');
        }

        public function especialidad()
        {
            return $this->belongsTo('App\Especialidad');
        }

        public function consultor()
        {
            $consultor = $this->hasOne('App\AtConsultor','attermino_id')->where('estado', '=', 'Seleccionado');
            return $consultor;
        }

        public function consultores()
        {
            return $this->hasMany('App\AtConsultor','attermino_id');
        }

        public function contrato(){
            return $this->hasOne('App\AtContrato','attermino_id');
        }

        public function acta(){
            return $this->hasOne('App\Acta','attermino_id');
        }

        public function ampliacion(){
            return $this->hasOne('App\AmpliacionContrato', 'attermino_id');
        }

}
