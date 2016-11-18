<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;
use Auth;

class AtAmpliacion extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'ampliacionescontratos';
    public $errores;
    protected $fillable = array(
        'fecha',
        'tiempo_ampliacion',
        'periodo',
        'razonamiento',
        'attermino_id',
        'solicitante'
    );

    protected $periodo = ['day', 'week', 'month'];
    
    /* Guardar */

        public function guardar($datos,$accion)
        {
            if($this->validar($datos)) 
            {
                $date = strtotime($datos['fecha']);

                $datos['fecha'] = date('Y-m-d', $date);

                $this->fill($datos);
                $this->save();
                $id = $this->id;
                $bitacora = new Bitacora;
                $campos = array(
                    'usuario_id' => Auth::user()->id,
                    'tabla' => 14,
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
                'fecha' => 'required',
                'tiempo_ampliacion' => 'required',
                'periodo' => 'required',
                'razonamiento' => 'required',
                'solicitante' => 'required',
                'attermino_id' => 'required'

            );
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }

        public function fechaRecibo($fecha){
            // 'return '
            $fecha = Carbon::parse($fecha);
            switch ($this->attributes['periodo']) {
                case 'Dias':
                    $fecha = $fecha->addDays($this->attributes['tiempo_ampliacion']);
                    break;
                case 'Semanas':
                    $fecha = $fecha->addWeek($this->attributes['tiempo_ampliacion']);
                    break;
                case 'Meses':
                    $fecha = $fecha->addMonth($this->attributes['tiempo_ampliacion']);
                    break;
            }
            return $fecha->format('Y/m/d');
        }

    /* Relaciones */
 
        public function atConsultores()
        {
            return $this->belongsTo('App\AtConsultor','atconsultor_id');
        }

}