<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use Auth;
use Carbon\Carbon;

class Empresa extends Model {

    use SoftDeletes;
    protected $table = 'empresas';
    public $errores;
    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'nombre',
        'categoria',
        'descripcion',
        'municipio_id',
        'direccion',
        'registro_iva',
        'constitucion',
        'clasificacion',
        'sector_economico',
        'actividad',
        'nit',
        'ubicacion'
    );

    protected $appends = ['paso','municipio', 'empresario', 'aporte'];

    /* Validaciones */

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
                    'tabla' => 9,
                    'tabla_id' => $id,
                    'accion' => $accion
                );

                $bitacora->guardar($campos);
                return true;
            }

            return false;
        }


    /* Fin atributos personalizados */
        public function validar($datos)
        {
            $rules = array(
                'nombre' => 'required',
                // 'categoria'  => 'required',
                // 'descripcion'  => 'required',
                // 'direccion'  => 'required',
                // 'registro_iva'  => 'required',
                // 'constitucion'  => 'required',
                // 'clasificacion'  => 'required',
                // 'sector_economico'  => 'required',
                // 'actividad'  => 'required',
                // 'nit'  => 'required',
            );

            $validator = Validator::make($datos,$rules);

            if($validator->passes())
                return true;

            $this->errores = $validator->errors();
            return false;
        }

        /* Atributos personalizados */

        public function getPasoAttribute(){

            if($this->proyectos != '[]')
                return 5;
            elseif($this->indicador)
                return 4;
            elseif($this->empresarios != '[]')
                return 3;

            return 2;
        }

        public function getEmpresarioAttribute(){
            return $this->empresarios()->first();
        }

        public function getAporteAttribute(){
            // Tamaño
            $aporte = true;
            $empresario = $this->empresario;

            if ($empresario) {

                if ($this->clasificacion == 'Subsistencia') {
                    $tamano = 5;
                    // Genero
                    if ($empresario->sexo == 'Mujer') {
                        $genero = 3;
                    }else{
                        $genero = 5;
                    }
                    // Ubicacion
                    if ($this->ubicacion == 'Rural') {
                        $ubicacion = 5;
                    }else{
                        $ubicacion = 2;
                    }
                    // Generacional
                    if ($this->empresario->edad <= 25) {
                        $generacional = 3;
                    }elseif ($this->empresario->edad > 25){
                        $generacional = 5;
                    }
                    // Sector
                    if ($this->sector_economico == 'Calzado' or $this->sector_economico == 'Comercio' or $this->sector_economico == 'Otros' ) {
                        $sector = 10; //No estrategico
                    }else{
                        $sector = 5; //Estrategico
                    }
                    // Asociatividad
                    if ($this->constitucion == 'Persona Natural' or $this->constitucion == 'Informal Natural') {
                        $asociatividad = 10; //No asociada
                    }else{
                        $asociatividad = 5;
                    }
                }elseif ($this->clasificacion == 'Micro-empresa'){
                    $tamano = 10;
                    // Genero
                        if ($empresario->sexo == 'Mujer') {
                            $genero = 5;
                        }else{
                            $genero = 10;
                        }
                    // Ubicacion
                    if ($this->ubicacion == 'Rural') {
                        $ubicacion = 10;
                    }else{
                        $ubicacion = 3;
                    }
                    // Generacional
                    if ($this->empresario->edad <= 25) {
                        $generacional = 5;
                    }elseif ($this->empresario->edad > 25){
                        $generacional = 10;
                    }
                    // Sector
                    if ($this->sector_economico == 'Calzado' or $this->sector_economico == 'Comercio' or $this->sector_economico == 'Otros' ) {
                        $sector = 10; //No estrategico
                    }else{
                        $sector = 5; //Estrategico
                    }
                    // Asociatividad
                    if ($this->constitucion == 'Persona Natural' or $this->constitucion == 'Informal Natural') {
                        $asociatividad = 10; //No asociada
                    }else{
                        $asociatividad = 5;
                    }
                }elseif ($this->clasificacion == 'Pequeña Empresa'){
                    $tamano = 20;
                    // Genero
                        if ($empresario->sexo == 'Mujer') {
                            $genero = 10;
                        }else{
                            $genero = 20;
                        }
                    // Ubicacion
                    if ($this->ubicacion == 'Rural') {
                        $ubicacion = 20;
                    }else{
                        $ubicacion = 10;
                    }
                    // Generacional
                    if ($this->empresario->edad <= 25) {
                        $generacional = 5;
                    }elseif ($this->empresario->edad > 25){
                        $generacional = 10;
                    }
                    // Sector
                    if ($this->sector_economico == 'Calzado' or $this->sector_economico == 'Comercio' or $this->sector_economico == 'Otros' ) {
                        $sector = 20; //No estrategico
                    }else{
                        $sector = 10; //Estrategico
                    }
                    // Asociatividad
                    if ($this->constitucion == 'Persona Natural' or $this->constitucion == 'Informal Natural') {
                        $asociatividad = 20; //No asociada
                    }else{
                        $asociatividad = 10;
                    }
                }else{
                    $aporte = false;
                }
            }else{
                $aporte = false;
            }

            if ($aporte) {
                $suma = $tamano + $ubicacion + $genero + $generacional + $sector + $asociatividad;
                $aporte = round(($suma / 6), 2);
                return $aporte;
            }else{
                return '0';
            }
        }

        public function getMunicipioAttribute(){
            return $this->municipio()->pluck('nombre')->first();
        }


	/* Relaciones */

        public function terminos()
        {
            return $this->hasMany('App\Models\At\Termino','empresa_id');
        }

        public function empresarios()
        {
            return $this->hasMany('App\Models\Cliente\EmpresaEmpresario','empresa_id');
        }

        public function municipio()
        { 
            return $this->belongsTo('App\Models\Municipio');
        }

        public function indicadores(){
            return $this->hasOne('App\Models\Indicador', 'empresa_id');
        }

        public function proyectos(){
            return $this->hasMany('App\Models\proyecto', 'empresa_id');
        }
}
