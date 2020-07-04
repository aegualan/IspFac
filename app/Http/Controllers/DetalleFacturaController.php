<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleFactura;

class DetalleFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'detalle';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->ajax()){
            $iva = 1.12; //\Utilitarios::iva()*0.100;
            $detelleFac = DetalleFactura::where('codFactura','=',$id)->orderBy('codDetFactura','=','ASC')->get();
            if($detelleFac->count()>0){
                $Vifactura = \Vistas::VifacturasXCodFactura($id);
                $html = ' <p class="text-right"><strong>Factura Nro. 000-000-'.$Vifactura->codFactura.'</strong></p>
     <input type="hidden" id="codFacturaDetalle" value="'.$Vifactura->codFactura.'"/>
    <p class="text-left"><strong>Cédula/Ruc:</strong> '.$Vifactura->codPersona.' <strong>Dirección IP:</strong> '.$Vifactura->codIp.' </p>
    <p class="text-left"><strong>Cliente:</strong> '.$Vifactura->nomCompletoPersona.'</p>
 
    <p class="text-left"><strong>Lugar de Servicio:</strong> '.$Vifactura->direccion.'</p>';
                
                $html = $html.'<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th>Val. Unitario</th>
                <th>Val. Total</th>
            </tr>
        </thead>
        <tbody>';
             
             $subTotal = 0;         
              foreach ($detelleFac as $item){
                  $subTotal += $item->valUniDetFactura;
                  $html = $html.'  <tr>
                <td>'.$item->canDetFactura.'</td>
                <td>'.$item->desDetFactura.'</td>
                <td class="text-right">'.number_format($item->valUniDetFactura,2).'</td>
                <td class="text-right">'.number_format(($item->valUniDetFactura)*($item->canDetFactura),2).'</td>
            </tr>';
              }
          
              $html = $html .'
            <tr>
                <td colspan="2" rowspan="6" class="text-center"></td>
                <td class="text-right"><strong>TOTAL</strong></td>
                 <td class="text-right"> <strong>'.number_format($subTotal,2).'</strong></td>
            </tr>
        </tbody>

    </table>';
              $html = $html.'<p class="text-justify"><strong>Observacion:</strong> '.$Vifactura->obsFactura.'</p>
                  
    <table class="table">
        <tr>
            <td><label class="control-label colorLabel" for="chkDif">No pagar Todo:</label></td>
            <td><input type="checkbox" id="chkDif" onclick="validarCheckPago();"/></td>
        </tr>
        <tr style="display: none" id="valP">
            <td colspan="1">
                <div class="form-group">
                    <label class="col-sm-6 control-label colorLabel" for="totalFac">
                        Valor Pagar:
                    </label>
                    <div class="col-sm-6">
                        <input class="form-control altoTxt" id="totalFac" onkeyup="return obligatorioSoloNumeros('."'"."totalFac"."'".');" type="text">
                        <span class="help-block">
                        </span>
                        </input>
                    </div>
                </div>
            </td>
        </tr>
    </table>
                  
    <p class="text-center"> <button onclick="registrarPagoDesdeDetalle();" type="button" class="btn btn-social btn-linkedin btn-sm"><i class="fa fa-dollar"></i> Registrar Pago</button></p>';
                
                
                return response()->json(['detalle'=>$html]);
               //echo $html;
            }
        }else{
            return redirect('/home'); 
        }
       // return response()->json(\App\DetalleFactura::where('codFactura','=',$id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
