<?php

namespace App\Http\Controllers;

use App\Servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Factura;
use Auth;

class FacturaPendienteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (\Utilitarios::accesoPermitido()) {
            //  $datos["clientes"] = Persona::all();
            return view('factura.facturaPendiente');
        } else {
            return \Utilitarios::sacarSistema();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if ($request->ajax()) {
            return datatables()->collection(\Vistas::Vifacturas('!=', 'PAG'))->toJson();
        } else {
            return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->ajax()) {
            $Vifactura = \Vistas::VifacturasXCodFactura($request->codFactura);

            if ($Vifactura != null) {
                if ($Vifactura->estFactura == "SUS") {
                    $facturas = Factura::where('codContrato', '=', $Vifactura->codContrato)->where('estFactura', '=', 'SUS')->get();
                    if ($facturas->count() == \Utilitarios::nroFacPenPermitido()) {
                        $this->conectarSevidorMikrotik($request->codFactura);
                        if ($request->tipoPago == "PAG") {
                            DB::select("CALL sp_cobrarFacturasPendientes('" . $request->codFactura . "')");
                        } else {
                            DB::select("CALL sp_crearFacturas('" . $request->codFactura . "','" . $Vifactura->codContrato . "'," . number_format($request->totalFac, 2) . ")");
                        }
                    } else {
                        if ($request->tipoPago == "PAG") {
                            DB::select("CALL sp_cobrarFacturasPendientes('" . $request->codFactura . "')");
                        } else {
                            DB::select("CALL sp_crearFacturas('" . $request->codFactura . "','" . $Vifactura->codContrato . "'," . number_format($request->totalFac, 2) . ")");
                        }
                    }
                } else {
                    if ($request->tipoPago == "PAG") {
                        DB::select("CALL sp_cobrarFacturasPendientes('" . $request->codFactura . "')");
                    } else {
                        DB::select("CALL sp_crearFacturas('" . $request->codFactura . "','" . $Vifactura->codContrato . "'," . number_format($request->totalFac, 2) . ")");
                    }
                }
            }
        } else {
            return redirect('/home');
        }
    }

    public function promesaPago(Request $request) {
        if ($request->ajax()) {
            $Vifactura = \Vistas::VifacturasXCodFactura($request->codFactura);
            if ($Vifactura != null) {
                if ($Vifactura->estFactura == "SUS") {
                    $facturas = Factura::where('codContrato', '=', $Vifactura->codContrato)->where('estFactura', '=', 'SUS')->get();
                    if ($facturas->count() == \Utilitarios::nroFacPenPermitido()) {
                        $this->conectarSevidorMikrotik($request->codFactura);
                        DB::select("CALL sp_promesaDePagoFacPen ('" . $Vifactura->codContrato . "','" . $request->fecPago . "')");
                    } else {
                        DB::select("CALL sp_promesaDePagoFacPen ('" . $Vifactura->codContrato . "','" . $request->fecPago . "')");
                    }
                } else {
                    DB::select("CALL sp_promesaDePagoFacPen ('" . $Vifactura->codContrato . "','" . $request->fecPago . "')");
                }
            }
        } else {
            return redirect('/home');
        }
    }

    private function conectarSevidorMikrotik($codFactura) {
        $Vifactura = \Vistas::VifacturasXCodFactura($codFactura);
        $servMikrotik = Servidor::where('codServidor', '=', $Vifactura->codServidor)->first();
        $API = new \ApiMikrotik();
        $API->debug = false;
        $API->port = $servMikrotik->portServidor;
        if ($API->connect($servMikrotik->ipServidor, $servMikrotik->userServidor, $servMikrotik->passServidor)) {
            $API->write('/ip/firewall/address-list/print');
            $ARRAY = $API->read();
            for ($i = 0; $i < count($ARRAY); $i++) {
                if ($ARRAY[$i]["address"] == $Vifactura->codIp) {
                    $API->write("/ip/firewall/address-list/set", false);
                    $API->write("=.id=" . $ARRAY[$i]['.id'], false);
                    $API->write('=list=' . $Vifactura->codPlan, true);
                    $API->read(false);
                    break;
                }
            }
            $band = true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (Auth::check()) {
            $factura = \Vistas::Vifacturas('!=', 'PAG');
            $nombreArchivo = "";
            $facPen = DB::table('facturas')
                    ->join('contratos', 'facturas.codContrato', '=', 'contratos.codContrato')
                    ->select(
                            DB::raw("(SELECT  COUNT(*)FROM facturas WHERE codContrato = contratos.codContrato) AS nroFacturas"), DB::raw("(SELECT MAX(fecPagFactura) FROM facturas WHERE codContrato = contratos.codContrato) AS fecPag"), 'contratos.codIp', 'contratos.codContrato'
                    )
                    ->groupBy('facturas.fecPagFactura')
                    ->groupBy('contratos.codIp')
                    ->groupBy('contratos.codContrato')
                    ->where('contratos.codIp', '=', $id)
                    //  ->where('contratos.codIp', '=', $ARRAY[$i]['address'])
                    ->where('facturas.estFactura', '!=', 'PAG')
                    ->first();

            if ($facPen != null) {
                $html = "";
                if ($factura->count() > 0) {
                    foreach ($factura as $itemFactura) {
                        if ($itemFactura->codContrato == $facPen->codContrato) {

                            $Vifactura = \Vistas::VifacturasXCodFactura($itemFactura->codFactura);
                            $nombreArchivo = $itemFactura->nomCompletoPersona;
                            $detelleFac = \App\DetalleFactura::where('codFactura', '=', $itemFactura->codFactura)->orderBy('codDetFactura', '=', 'ASC')->get();
                            $html = $html . '
        <table style="width: 100%">
            <tr>
                <td style="width: 50%">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: center; width: 100%"><img src="assets/img/logo.png" style="height: 100px"></td>
                        </tr>
                        <tr>
                            <td style="width: 100%">
                                <div style="border: 1px solid black; border-radius: 10px; width: 100%">
                                    <h6 style="text-align: center">TELCOMPSYSTEMS. CIA. LTDA.</h6>
                                    <p style="text-align: justify"><strong>Direccion Matriz:</strong> PUENTE EL CABALLITO - CHILLOGAL Calle: OE7CCCNumero: S31-
                                        140 Interseccion: MANUEL CHERREZ</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%">
                    <div style="border: 1px solid black; border-radius: 10px; width: 100%">
                     <br/><br/>
                      <p style="text-align: center"><strong>DOCUMENTO SIN VALIDEZ TRIBUTARIO </strong></p>  
                        <p style="text-align: justify"><strong>R.U.C.: </strong>1792905028001</p>
                        <p style="text-align: justify"><strong>COMPROBANTE</strong> Nro. 000-000-' . $itemFactura->codFactura . '</p>
          
                        <p style="text-align: justify"><strong>FECHA MAXIMO DE PAGO</strong> ' . strval($itemFactura->fecPagFactura) . ' </p>      
 <br/><br/>
</div>
                   
                </td>
            </tr>
        </table>
        <!--        </div>-->
        </br>
        <div style="border: 1px solid black; width: 100%">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%"><strong>Cliente:</strong></td>
                    <td style="width: 50%" style="text-align: justify">' . $itemFactura->nomCompletoPersona . '</td>
                    <td style="width: 10%"><strong>Identificación:</strong></td>
                    <td style="width: 10%">' . $itemFactura->codPersona . '</td>
                </tr>
                <tr>
                    <td><strong>Dirección</strong></td>
                    <td colspan="4" style="text-align: justify">' . $itemFactura->direccion . '</td>
                </tr>
            </table>
        </div>
        <br/>
           <table border="1" style="width: 100%">
            <thead>
                <tr>
                    <th>Cant.</th>
                    <th>Descripción</th>
                    <th>Val. Unitario</th>
                    <th>Descuento</th>
                    <th>Val. Total </th>
                </tr>
            </thead>
                 <tbody>';

                            $subTotal = 0;
                            $descuento = 0;
                            foreach ($detelleFac as $item) {
                                $subTotal += (($item->valUniDetFactura * $item->canDetFactura) - $item->descDetFactura);
                                $descuento += $item->descDetFactura;
                                $html = $html . '  <tr>
                <td>' . $item->canDetFactura . '</td>
                <td>' . $item->desDetFactura . '</td>
                <td style="text-align: right">' . number_format($item->valUniDetFactura, 2) . '</td>
                    <td style="text-align: right">' . number_format($item->descDetFactura, 2) . '</td>
                <td style="text-align: right">' . number_format((($item->valUniDetFactura * $item->canDetFactura) - $item->descDetFactura), 2) . '</td>
            </tr>';
                            }

                            $html = $html . '
            <tr>
                <td colspan="3" rowspan="6" style="text-align: justify"> ' . $itemFactura->obsFactura . '</td>
                <td style="text-align: right"><strong>TOTAL DESC.</strong></td>
                 <td style="text-align: right"> <strong>' . number_format($descuento, 2) . '</strong></td>
            </tr>
            <tr>
  <td style="text-align: right"><strong>TOTAL PAGAR</strong></td>
                 <td style="text-align: right"> <strong>' . number_format($subTotal - $descuento, 2) . '</strong></td>            
</tr>
        </tbody>
        </table>
        
       
<div style="page-break-after: always;"></div>';
                        }
                    }
                }
                $pdf = \PDF::loadHTML($html);

                return $pdf->download($nombreArchivo . '.pdf');
            }
        } else {
            return redirect('/home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
