<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Departamento extends Model {

    use SoftDeletes;
    protected $table = 'departamentos';

    /* Relaciones */

        //
        public function municipios() 
        {
            return $this->hasmany('App\Models\Municipio','departamento_id');
        }
        
}