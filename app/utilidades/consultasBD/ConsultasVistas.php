<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\utilidades\consultasBD;

/**
 * Description of ConsultasVistas
 *
 * @author ssp08
 */
use Illuminate\Support\Facades\DB;
use Auth;
class ConsultasVistas {

    //put your code here

    public static function Vifacturas($condicion, $estado) {
        try {
            if (Auth::check()) {
            return DB::table('facturas')
                            ->join('contratos', 'facturas.codContrato', 'contratos.codContrato')
                            ->join('personas', 'contratos.codPersona', 'personas.codPersona')
                            ->select(
                                    'contratos.codIp','contratos.codPlan', 'contratos.codContrato', 'personas.codPersona', 'contratos.estContrato', 'facturas.obsFactura', 'facturas.totFactura', 'facturas.codFactura', 'facturas.estFactura',
                                    DB::raw("DATE_FORMAT(facturas.fecPagFactura,'%d/%m/%Y') as fecPagFactura")
                                    ,DB::raw(" CONCAT((SELECT apePersona FROM personas WHERE codPersona = contratos.codPersona), ' ',
                                    (SELECT nomPersona FROM personas WHERE codPersona = contratos.codPersona)) AS nomCompletoPersona"), DB::raw("(SELECT nomPlan FROM planes WHERE codPlan = SUBSTRING_INDEX(contratos.codPlan, '_', 2)) AS nomPlan"), DB::raw("(CONCAT(ELT(MONTH(facturas.fecGenFactura),'ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE',
                                    'NOVIEMBERE','DICIEMBRE'),' ',YEAR(facturas.fecGenFactura))) AS mesServicio"), Db::raw("(SELECT prePlan FROM planes WHERE codPlan = SUBSTRING_INDEX(contratos.codPlan, '_', 2)) AS prePlan"), DB::raw("(SELECT codServidor FROM ips WHERE codIp = contratos.codIp) AS codServidor"), DB::raw("(SELECT CONCAT(ciuDireccion,' - ',secDireccion) FROM direcciones WHERE codDireccion = contratos.codDireccion) as direccion"),
                                    DB::raw("(SELECT COUNT(*) FROM facturas JOIN contratos ON facturas.codContrato = contratos.codContrato
                                    WHERE facturas.estFactura = 'SUS') as estServicio")
                            )
                            ->where('facturas.estFactura',$condicion, $estado)
                    ->orderBy('facturas.fecPagFactura')
                            ->orderBy('personas.apePersona', 'asc')
                            ->get();
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function VifacturasXCodFactura($codFactura) {
        try {
            if (Auth::check()) {
            return DB::table('facturas')
                            ->join('contratos', 'facturas.codContrato', 'contratos.codContrato')
                            ->join('personas', 'contratos.codPersona', 'personas.codPersona')
                            ->select(
                                    'contratos.codIp','contratos.codPlan', 'contratos.codContrato', 'personas.codPersona', 'contratos.estContrato', 'facturas.obsFactura', 'facturas.totFactura', 'facturas.codFactura','facturas.estFactura',
                                    DB::raw("DATE_FORMAT(facturas.fecPagFactura,'%d/%m/%Y') as fecPagFactura"), 
                                    DB::raw(" CONCAT((SELECT apePersona FROM personas WHERE codPersona = contratos.codPersona), ' ',
                                    (SELECT nomPersona FROM personas WHERE codPersona = contratos.codPersona)) AS nomCompletoPersona"), DB::raw("(SELECT nomPlan FROM planes WHERE codPlan = SUBSTRING_INDEX(contratos.codPlan, '_', 2)) AS nomPlan"), DB::raw("(CONCAT(ELT(MONTH(facturas.fecGenFactura),'ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE',
                                    'NOVIEMBERE','DICIEMBRE'),' ',YEAR(facturas.fecGenFactura))) AS mesServicio"), Db::raw("(SELECT prePlan FROM planes WHERE codPlan = SUBSTRING_INDEX(contratos.codPlan, '_', 2)) AS prePlan"), DB::raw("(SELECT codServidor FROM ips WHERE codIp = contratos.codIp) AS codServidor"), DB::raw("(SELECT CONCAT(ciuDireccion,' - ',secDireccion) FROM direcciones WHERE codDireccion = contratos.codDireccion) as direccion")
                            )
                            ->where('facturas.codFactura', '=', $codFactura)
                            ->first();
            }
        } catch (Exception $e) {
            return false;
        }
    }
    
  
    public static function Vicontratos(){
           try {
            if (Auth::check()) {
            return DB::table('contratos')
                            ->select(
                                    'codContrato','codPersona','estContrato','codIP',
                                    DB::raw("CONCAT((SELECT apePersona FROM personas WHERE codPersona = contratos.codPersona),' ',(SELECT nomPersona FROM personas WHERE codPersona = contratos.codPersona)) AS cliente"), 
                                    DB::raw("(SELECT nomPlan FROM planes WHERE codPlan = SUBSTRING_INDEX(contratos.codPlan, '_', 2)) AS nomPlan"), 
                                    Db::raw("(SELECT prePlan FROM planes WHERE codPlan = SUBSTRING_INDEX(contratos.codPlan, '_', 2)) AS prePlan"), 
                                    DB::raw("(SELECT codServidor FROM ips WHERE codIp = contratos.codIp) AS codServidor"), 
                                    DB::raw("(SELECT nomServidor FROM servidores WHERE codServidor = (SELECT codServidor FROM ips WHERE codIp = contratos.codIp)) AS nomServidor"),
                                    DB::raw("(SELECT CONCAT(ciuDireccion,' - ',secDireccion) FROM direcciones WHERE codDireccion = contratos.codDireccion) as direccion"),
                                    DB::raw("(SELECT codValInstalacion FROM valorInstalaciones WHERE codValInstalacion = contratos.codValInstalacion) as codValInstalacion"),
                                    DB::raw("(SELECT valTotValInstalacion FROM valorInstalaciones WHERE codValInstalacion = contratos.codValInstalacion) as ValInstalacion")
                                    
                            )
                            ->orderBy('codContrato', 'asc')
                            ->get();
            }
        } catch (Exception $e) {
            return false;
        }
    }

}
