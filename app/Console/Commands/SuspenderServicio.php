<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SuspenderServicio extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Suspender:Servicio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Suspender servicio a clientes quienes aun no pagan hasta la fecha maximo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
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
                                        $API->write("/ip/firewall/address-list/set", false);
                                        $API->write("=.id=" . $ARRAY[$i]['.id'], false);
                                        $API->write('=list=SUSPENDIDO', true);
                                        $API->read(false);
                                        DB::select("CALL sp_suspenderFacPen('" . date('Y-m-d') . "','" . $ARRAY[$i]["address"] . "')");
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}
