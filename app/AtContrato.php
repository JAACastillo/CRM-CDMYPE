<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;
use Auth;

class AtContrato extends Model {
    
    use SoftDeletes;
    protected $table = 'atcontratos';
    protected $fillable = array(
            'duracion',
            'fecha_inicio',
            'fecha_final',
            'pago',
            'aporte',
            'lugar_firma',
            'attermino_id'
    );

       /* Guardar */

        public function guardar($datos,$accion)
        {
            $date = strtotime($datos['fecha_inicio']);
            $datos['fecha_inicio'] = date('Y-m-d', $date);

            $date = strtotime($datos['fecha_final']);
            $datos['fecha_final'] = date('Y-m-d', $date);

            if($this->validar($datos))
            {
                $this->fill($datos);
                $this->save();
                $id = $this->id;
                $bitacora = new Bitacora;

                $campos = array(
                    'usuario_id' => Auth::user()->id,
                    'tabla' => 12,
                    'tabla_id' => $id,
                    'accion' => $accion
                );

                $bitacora->guardar($campos);
                return true;
            }
            return false;
        }


        //atributos

        public function getInicioAttribute(){

            $date = strtotime($this->fecha_inicio);
           return date('d/m/Y', $date);
        }
        public function getFinalAttribute(){

            $date = strtotime($this->fecha_final);
           return date('d/m/Y', $date);
        }


        public function getPagoCdmypeAttribute(){
            if($this->aporte)
                return ($this->pago * ($this->aporte) / 100);
            return $this->pago;
        }

        public function getPagoEmpresarioAttribute(){
            return $this->pago - $this->getPagoCdmypeAttribute();
        }

        /* Validaciones */

        public function validar($datos)
        {
            $reglas = array(
                'lugar_firma' => 'required',
                'fecha_inicio' => 'required',
                'fecha_final' => 'required',
                'duracion' => 'required',
                'pago' => 'numeric|required',
                'aporte' => 'numeric|required',
                'attermino_id' => 'required'
            );

            $validador = Validator::make($datos,$reglas);

            if($validador->passes())
                return true;

            $this->errores = $validador->errors();

            return false;
        }


        public function getVencidaAttribute(){
            $hoy = strtotime(date("d-m-Y", time()));
            $vencimiento = strtotime( $this->attributes['fecha_final']);
            return ($hoy > $vencimiento);
        }

	/* RELACIÓN */

        public function terminos()
        {
            return $this->belongsTo('App\AtTermino','attermino_id');
        }
        public function ampliacion(){
            return $this->hasOne('App\AmpliacionContrato', 'attermino_id');
        }


}
