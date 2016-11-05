<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Auth;
use Carbon\Carbon;

class EventoEmpresarios extends Model {

    use SoftDeletes;
	protected $table = 'empresario_evento';


	public function empresario(){
		return $this->belongsTo('Empresario');
	}

	public function evento(){
		return $this->belongsTo('Evento');
	}
} 