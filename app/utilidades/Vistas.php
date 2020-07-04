<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\utilidades;

/**
 * Description of Vistas
 *
 * @author ssp08
 */
use App\utilidades\consultasBD\ConsultasVistas;
use Auth;

class Vistas {

    public static function Vifacturas($condicion, $estado) {
        return ConsultasVistas::Vifacturas($condicion, $estado);
    }

    public static function VifacturasXCodFactura($codFactura) {
        return ConsultasVistas::VifacturasXCodFactura($codFactura);
    }
    
     public static function Vicontratos(){
         return ConsultasVistas::Vicontratos();
     }

}
