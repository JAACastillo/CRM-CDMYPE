<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;

class Especialidad extends Model {

    use SoftDeletes;

    protected $table = 'subespecialidades';
    protected $softDelete = true;
    
    /* Relaciones */

        //
        // public function subEspecialidades() 
        // {
        //     return $this->hasmany('SubEspecialidad','especialidad_id');
        // }

}