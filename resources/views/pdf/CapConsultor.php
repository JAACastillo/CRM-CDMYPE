<?php
class CapConsultor extends Eloquent {
    
    protected $table = 'capconsultores';
    public $errores;
    protected $perPage = 9;
    protected $softDelete = true;
    protected $fillable = array(
        'estado',
        'doc_oferta',
        'fecha_oferta',
        'fecha_seleccion',
        'captermino_id',
        'consultor_id'
    );
    
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
                    'tabla' => 19,
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
                'estado' => 'required',
                'captermino_id' => 'required',
                'consultor_id' => 'required'
            );
            
            $validador = Validator::make($datos,$reglas);
            
            if($validador->passes())
                return true;

            $this->errores = $validador->errors();
            return false;
        }

    /* Relaciones */


        public function capContratos() 
        {
            return $this->hasmany('CapContrato','capconsultor_id');
        }


        public function capTerminos() 
        {
            return $this->belongsTo('CapTerminos','captermino_id');
        }

        public function consultor() 
        {
            return $this->belongsTo('Consultor');
        }

}