<?php

namespace App\Models\Cap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Termino extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'capterminos';
    protected $fillable = array(
        'encabezado',
        'tema',
        'categoria',
        'descripcion',
        'obj_general',
        'obj_especifico',
        'productos',
        'lugar',
        'fecha',
        'fecha_lim',
        'hora_ini',
        'hora_fin',
        'nota',
        'estado',
        'especialidad_id',
        'usuario_id',
        'informe'
    );

    protected $appends = ['especialidad', 'asesor'];
        

    /* Guardar */

        public function guardar($datos,$accion)
        {
            $date = strtotime($datos['fecha']);
            $datos['fecha'] = date('Y-m-d', $date);

            $date = strtotime($datos['fecha_lim']);
            $datos['fecha_lim'] = date('Y-m-d', $date);

            if($this->validar($datos))
            {
                $this->fill($datos);
                $this->save();
                $id = $this->id;
                $bitacora = new Bitacora;

                $campos = array(
                    'usuario_id' => Auth::user()->id,
                    'tabla' => 20,
                    'tabla_id' => $id,
                    'accion' => $accion
                );

                $bitacora->guardar($campos);
                return true;
            }

            return false;
        }

    /* Validaciones */

        public function validar($datos) {

            $reglas = array(
                'encabezado' => 'max:500',
                'tema' => 'required|max:500',
                'categoria' => 'required',
                'descripcion' => 'required|max:3000',
                'obj_general' => 'required|max:2000',
                'obj_especifico' => 'required|max:5000',
                'productos' => 'required|max:3000',
                'lugar' => 'required|max:1000',
                'fecha' => 'required',
                'fecha_lim' => 'required',
                'hora_ini' => 'required',
                'hora_fin' => 'required',
                'nota' => 'max:3000',
                'especialidad_id' => 'required',
                'usuario_id' => 'required'
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

        }
        public function getConsultorSeleccionadoAttribute()
        {
            return $this->consultores()
                        ->where("estado", '=', 'Seleccionado')
                        ->orderby('updated_at', 'desc')
                        ->first();
        }

        public function getContratoAttribute()
        {
            return $this->contratos()
                        ->orderby('updated_at', 'desc')
                        ->first();
        }

        //Pasos
            public function getPasoRealAttribute(){
                // switch ($this->estado) {
                //     case 'Creado':
                //         return 2;
                //         break;
                //     case 'Enviado':
                //         return 4;
                //         break;
                //     case 'Ofertas Recibidas':
                //         return 5;
                //         break;
                //     case 'Consultor Seleccionado':
                //         return 7;
                //         break;
                //     case 'Contratada':
                //         return 8;
                //         break;
                //     case 'Finalizada':
                //         return 8;
                //         break;
                //     default:
                //         # code...
                //         break;
                // }

            }

        public function getFechaaAttribute(){

            $date = strtotime($this->fecha);
           return date('d/m/Y', $date);
        }
        public function getFecha_limiteAttribute(){

            $date = strtotime($this->fecha_lim);
           return date('d/m/Y', $date);
        }

        public function getEspecialidadAttribute(){
            return $this->especialidad()->pluck('nombre')->first();
        }

        public function getAsesorAttribute(){
            return $this->usuario()->pluck('nombre')->first();
        }


    /* Relaciones */

        public function usuario()
        {
            return $this->belongsTo('App\User');
        }

        public function especialidad()
        {
            return $this->belongsTo('App\Models\Especialidad');
        }

        public function consultor()
        {
            $consultor = $this->hasOne('App\Models\Cap\Consultor','captermino_id')->where('estado', '=', 'Seleccionado');

            return $consultor;
        }

        public function contrato(){
            return $this->hasOne('App\Models\Cap\Contrato', 'captermino_id');
        }

        public function asistencia(){
            return $this->hasOne('App\Models\Cap\Asistencia', 'captermino_id');
        }

        public function envios(){
            return $this->hasMany('App\Models\Cap\CapacitacionEnvios', 'capacitacion_id');
        }


}
