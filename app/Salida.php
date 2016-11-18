<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;
use Auth;

class Salida extends Model {

    use SoftDeletes;
    public $errores;
    protected $dates = ['deleted_at'];
    protected $fillable = ['estado', 'observacion', 'fecha_inicio', 'hora_salida',
                        'hora_regreso', 'lugar_destino', 'justificacion', 'objetivo',
                        'encargado'];
    protected $appends = ['responsable', 'municipio'];

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
                 'tabla' => 26,
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
                'observacion'   => 'required',
                'fecha_inicio'  => 'required',
                'hora_salida'   => 'required',
                'hora_regreso'  => 'required',
                'lugar_destino' => 'required',
                // 'participantes' => 'required',
                'justificacion' => 'required',
                'objetivo'      => 'required',
                'encargado'     => 'required'

            );
                      
            $validator = Validator::make($datos,$reglas);

            if($validator->passes()) 
                return true;

            $this->errores = $validator->errors();
            return false;
        }

    public function getMunicipioAttribute(){
        return $this->municipio()->pluck('nombre')->first();
    }

    public function getResponsableAttribute(){
        return $this->user()->pluck('nombre')->first();
    }

     //relaciones

     public function municipio()
     {
        return $this->belongsTo('App\Municipio', 'lugar_destino');
     }

     public function user()
     {
        return $this->belongsTo('App\User', 'encargado');
     }

     public function participantes(){
        return $this->hasMany('App\SalidaParticipante');
     }
}

