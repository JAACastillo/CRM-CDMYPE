<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Carbon\Carbon;
use Auth;

class EmpresaEmpresario extends Model {

    use SoftDeletes;
    protected $table = 'empresasempresarios';
    public $errores;
    protected $fillable = array(
        'tipo',
        'empresario_id',
        'empresa_id'
    );

    protected $appends = ['empresa', 'empresario', 'sector', 'sexo', 'edad'];

    /* Guardar */

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
                    'tabla' => 6,
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
                'tipo' => 'required',
                'empresario_id' => 'required',
                'empresa_id' => 'required'
            );

            $validador = Validator::make($datos,$reglas);

            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }

        public function getEmpresaAttribute(){
            return $this->empresa()->pluck('nombre')->first();;
        }
        public function getSectorAttribute(){
            return $this->empresa()->pluck('sector_economico')->first();;
        }
        public function getEmpresarioAttribute(){
            return $this->empresario()->pluck('nombre')->first();;
        }
        public function getSexoAttribute(){
            return $this->empresario()->pluck('sexo')->first();;
        }
        public function getEdadAttribute(){
            return $this->empresario()->pluck('edad')->first();;
        }

	/* Relaciones */

        //
        public function empresa()
        {
            return $this->belongsTo('App\Empresa','empresa_id');
        }

        public function empresario()
        {
            return $this->belongsTo('App\Empresario','empresario_id');
        }


}
