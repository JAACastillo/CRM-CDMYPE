<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Bitacora extends Model {

    /* Atributos */
    use SoftDeletes;
    protected $table = 'bitacoras';
        protected $fillable = array(
            'usuario_id',
            'tabla',
            'tabla_id',
            'accion'
        );

    //Guardar
        public function guardar($datos) 
        {
            //Llenamos la bitacora y se guarda en la BD
            $this->fill($datos);
            $this->save();
        }
    
    /* RELACIÓN */

        public function usuarios() 
        {
            return $this->belongsTo('App\User','usuario_id');
        }

    }