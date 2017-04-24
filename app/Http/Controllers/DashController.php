<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;
use Carbon\Carbon;
use stdClass;

use App\Models\Cliente\Empresa;
use App\Models\Cliente\Empresario;
use App\Models\Consultor;
use App\Models\ConsultorEspecialidad;
use App\Models\At\Termino as AtTermino;
use App\Models\At\Consultor as AtConsultor;
use App\Models\At\Contrato as AtContrato;
use App\Models\At\Ampliacion as AtAmpliacion;
use App\Models\Cap\Termino as CapTermino;
use App\Models\Cap\Consultor as CapConsultor;
use App\Models\Cap\Contrato as CapContrato;
use App\Models\Evento;

class DashController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){
        return view('dash.layout');
    }

    public function index($p) {
        try {
            // Se cargan todos los clientes de la empresa que no han sido eliminados
            $datos = new stdClass();
            // $datos->empresas    = Empresa::count();
            // $datos->empresarios = Empresario::count();
            // $datos->consultores = Consultor::count();
            $datos->ats = AtTermino::count();
            $datos->caps = CapTermino::count();
            $datos->eventos = Evento::count();

            // Empresas
            $datos->empresasTipos = Empresa::selectRaw('clasificacion, count(*) as total')->groupBy('clasificacion')->orderBy('total','desc')->get();
            $datos->empresasSector = Empresa::selectRaw('sector_economico, count(*) as total')->groupBy('sector_economico')->orderBy('total','desc')->take(6)->get();

            $datos->empresasMunicipios = Empresa::selectRaw('municipio_id, count(*) as total')->groupBy('municipio_id')->orderBy('total','desc')->take(6)->get();

            // Consultores
            $datos->consultorEspecialidad = ConsultorEspecialidad::selectRaw('especialidad_id, count(*) as total')->groupBy('especialidad_id')->orderBy('total','desc')->take(6)->get();

            $datos->consultorAt = AtConsultor::selectRaw('consultor_id, count(*) as total')->groupBy('consultor_id')->where('estado','Seleccionado')->orderBy('total','desc')->take(6)->get();

            $datos->consultorCap = CapConsultor::selectRaw('consultor_id, count(*) as total')->groupBy('consultor_id')->where('estado','Seleccionado')->orderBy('total','desc')->take(6)->get();
            
            // At
            $datos->atTipos = AtTermino::selectRaw('especialidad_id, count(*) as total')->groupBy('especialidad_id')->orderBy('total','desc')->take(6)->get();

            $datos->atEstado = AtTermino::selectRaw('estado, count(*) as total')->groupBy('estado')->orderBy('total','desc')->take(6)->get();
            $datos->atAsesor = AtTermino::selectRaw('usuario_id, count(*) as total')->groupBy('usuario_id')->orderBy('total','desc')->take(6)->get();

            $datos->atPago = AtContrato::sum('pago');
            $datos->atAporte = AtContrato::sum('aporte');
            $datos->ampliaciones = AtAmpliacion::count();

            // Cap
            $datos->capTipos = CapTermino::selectRaw('especialidad_id, count(*) as total')->groupBy('especialidad_id')->orderBy('total','desc')->take(6)->get();

            $datos->capEstado = CapTermino::selectRaw('estado, count(*) as total')->groupBy('estado')->orderBy('total','desc')->take(6)->get();
            $datos->capAsesor = CapTermino::selectRaw('usuario_id, count(*) as total')->groupBy('usuario_id')->orderBy('total','desc')->take(6)->get();
            
            $datos->capPago = CapContrato::sum('pago');

            

            return Response::json($datos, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

}
