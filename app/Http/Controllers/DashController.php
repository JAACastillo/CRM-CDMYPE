<?php

namespace App\Http\Controllers;

use Response;
use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers\Input;
use Carbon\Carbon;
use stdClass;
use App\Empresa;
use App\Empresario;
use App\Consultor;
use App\ConsultorEspecialidad;
use App\AtTermino;
use App\AtContrato;
use App\CapTermino;
use App\Evento;
use App\AmpliacionContrato;
use App\CapContrato;

class DashController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        try {
            // Se cargan todos los clientes de la empresa que no han sido eliminados
            $datos = new stdClass();
            $datos->empresas    = Empresa::count();
            $datos->empresarios = Empresario::count();
            $datos->consultores = Consultor::count();
            $datos->ats = AtTermino::count();
            $datos->caps = CapTermino::count();
            $datos->eventos = Evento::count();

            // Empresas
            $datos->empresasTipos = Empresa::selectRaw('categoria, count(*) as total')->groupBy('categoria')->orderBy('total','desc')->get();

            $datos->empresasMunicipios = Empresa::selectRaw('municipio_id, count(*) as total')->groupBy('municipio_id')->orderBy('total','desc')->take(5)->get();

            // Consultores
            $datos->consultoresTipos = ConsultorEspecialidad::selectRaw('especialidad_id, count(*) as total')->groupBy('especialidad_id')->orderBy('total','desc')->get();
            
            // At
            $datos->atTipos = AtTermino::selectRaw('especialidad_id, count(*) as total')->groupBy('especialidad_id')->orderBy('total','desc')->take(8)->get();

            $datos->atEstado = AtTermino::selectRaw('estado, count(*) as total')->groupBy('estado')->orderBy('total','desc')->take(8)->get();
            $datos->atAsesor = AtTermino::selectRaw('usuario_id, count(*) as total')->groupBy('usuario_id')->orderBy('total','desc')->take(8)->get();

            $datos->atPago = AtContrato::sum('pago');
            $datos->atAporte = AtContrato::sum('aporte');
            $datos->ampliaciones = AmpliacionContrato::count();

            // Cap
            $datos->capTipos = CapTermino::selectRaw('especialidad_id, count(*) as total')->groupBy('especialidad_id')->orderBy('total','desc')->take(8)->get();

            $datos->capEstado = CapTermino::selectRaw('estado, count(*) as total')->groupBy('estado')->orderBy('total','desc')->take(8)->get();
            $datos->capAsesor = CapTermino::selectRaw('usuario_id, count(*) as total')->groupBy('usuario_id')->orderBy('total','desc')->take(8)->get();
            
            $datos->capPago = CapContrato::sum('pago');

            

            return Response::json($datos, 200);
            
        } catch (Exception $e) {
            // Si hay error de servidor se envia el error
            return Response::json($e, 500);
        }
    }

}
