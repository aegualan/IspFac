<?php

namespace App\utilidades;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\utilidades\consultasBD\Consultas;
use Auth;

class Utilitarios {

    public static function personaLogueado() {
        if (Auth::check()) {
            $nombrePersona = "";
            $ViPersonas = Consultas::ViPersonas();
            if ($ViPersonas->count()) {
                foreach ($ViPersonas as $item) {
                    $nombrePersona = $item->nomComPer;
                }
            }
            return $nombrePersona;
        }
        //funciona implementar
    }

    public static function getRol() {
        if (Auth::check()) {
            $nombreRol = "";
            $ViPersonas = Consultas::ViPersonas();
            if ($ViPersonas->count()) {
                foreach ($ViPersonas as $item) {
                    $nombreRol = $item->nomRol;
                }
            }
            return $nombreRol;
        }
    }

    public static function getMenuOpciones() {
        return Consultas::ViOpciones(Consultas::getCodRol());
    }

    public static function accesoPermitido() {
        if (Auth::check()) {
            $band = false;
            $ViOpciones = Consultas::ViopcionesXUrl(Consultas::getCodRol(), substr($_SERVER['REQUEST_URI'], 1));
            if ($ViOpciones->count() > 0) {
                $band = true;
            }
            return $band;
        }
    }

    public static function titulo() {
        if (Auth::check()) {
            $ViOpciones = Consultas::ViopcionesXUrl(Consultas::getCodRol(), substr($_SERVER['REQUEST_URI'], 1));
            $nomOpcion = "";
            if ($ViOpciones->count() > 0) {
                foreach ($ViOpciones as $item) {
                    $nomOpcion = $item->nomOpcion;
                }
            }
            return $nomOpcion;
        }
    }

    public static function sacarSistema() {
        try {
            auth()->logout();
            return redirect('/login');
        } catch (Exception $e) {
            return false;
        }
    }

    public static function iva() {
        try {
            return 12;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function nroFacPenPermitido() {
        try {
            return 1;
        } catch (Exception $e) {
            return false;
        }
    }

//funciones privadas que se utilizada dentro de la misma clase
}
