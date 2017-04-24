<?php

namespace App\Models;

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
            return $this->hasMany('App\Models\Empresa','municipio_id');
        }

        public function empresarios() 
        {
            return $this->hasMany('App\Models\Empresario','municipio_id');
        }

        public function departamento() 
        {
            return $this->belongsTo('App\Models\Departamento');
        }
        
}