<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Municipio extends Model {

    use SoftDeletes;
    protected $table = 'municipios';

    /* Relaciones */

        //
        public function empresas() 
        {
            return $this->hasMany('App\Empresa','municipio_id');
        }

        public function empresarios() 
        {
            return $this->hasMany('App\Empresario','municipio_id');
        }

        public function departamento() 
        {
            return $this->belongsTo('App\Departamento','departamento_id');
        }
        
}