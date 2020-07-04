<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class GenerarFactura extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factura:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generar Facturas de clientes cada mes';

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
                        DB::select("CALL sp_generarFacturas('" . $ARRAY[$i]["address"] . "')");
                    }
                }
            };
        }
    }

}
