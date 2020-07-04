<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('traer-opciones', 'OpcionController@mostrarOpciones');
//Auth::routes();

Route::resource('clientes', 'PersonaController');
Route::resource('facturas-pendientes', 'FacturaPendienteController');
Route::post('facturas-pendientes/promesa-pago', 'FacturaPendienteController@promesaPago');
Route::resource('facturas-cobradas', 'FacturaCobradoController');
Route::resource('detalleFacturas', 'DetalleFacturaController');


Route::get('/pruebaS', function () {


    $servidor = DB::table('servidores')->get();
    if ($servidor->count() > 0) {
        $API = new \ApiMikrotik();
        foreach ($servidor as $item) {

            $API->debug = false;
            $API->port = $item->portServidor;
            if ($API->connect($item->ipServidor, $item->userServidor, $item->passServidor)) {
                $API->write('/ip/firewall/address-list/print');
                $ARRAY = $API->read();
                for ($i = 0; $i < count($ARRAY); $i++) {
                    $facPen = DB::table('facturas')
                            ->join('contratos', 'facturas.codContrato', '=', 'contratos.codContrato')
                            ->select(
                                    DB::raw("(SELECT  COUNT(*)FROM facturas WHERE codContrato = contratos.codContrato) AS nroFacturas"), DB::raw("(SELECT MAX(fecPagFactura) FROM facturas WHERE codContrato = contratos.codContrato) AS fecPag"), 'contratos.codIp'
                            )
                            ->groupBy('facturas.fecPagFactura')
                            ->groupBy('contratos.codIp')
                            ->groupBy('contratos.codContrato')
                            ->where('contratos.codIp', '=', $ARRAY[$i]['address'])
                            ->where('facturas.estFactura', '!=', 'PAG')
                            ->first();

                    if ($facPen != null) {
                        if ($facPen->nroFacturas >= \Utilitarios::nroFacPenPermitido()) {
                            $fecha = new \DateTime($facPen->fecPag);
                            $fecBase = $fecha->format('Y-m-d');
                            if ($fecBase == date('Y-m-d')) {
                                if ($ARRAY[$i]["address"] == $facPen->codIp) {
                                    echo $ARRAY[$i]["address"] . ' - ' . $facPen->codIp . '</br>';
                                  /*  $API->write("/ip/firewall/address-list/set", false);
                                    $API->write("=.id=" . $ARRAY[$i]['.id'], false);
                                    $API->write('=list=SUSPENDIDO', true);
                                    $API->read(false);
                                    DB::select("CALL sp_suspenderFacPen('" . date('Y-m-d') . "','" . $ARRAY[$i]["address"] . "')");
                              */
                                     }
                                   
                            }
                        }
                    }
                }
            }
        }
    }
});
