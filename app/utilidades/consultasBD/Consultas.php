<?php

//namespace App\utilidades\consultasBD;

namespace App\utilidades\consultasBD;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Consultas
 *
 * @author ssp08
 */
use Auth;
use Illuminate\Support\Facades\DB;

class Consultas {

    public static function ViPersonas() {
        try {
            if (Auth::check()) {
                return DB::table('users')
                                ->join('personas', 'users.codPersona', '=', 'personas.codPersona')
                                ->join('roles', 'personas.codRol', '=', 'roles.codRol')
                                ->select('roles.codRol', 'roles.nomRol', 'personas.codPersona', DB::raw('CONCAT(personas.apePersona," ",personas.nomPersona) AS nomComPer')
                                )
                                ->where('personas.codPersona', '=', Auth::user()->codPersona)
                                ->get();
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getCodRol() {
        try {
            $codRol = "";
            if (Auth::check()) {
                $rol = DB::table('personas')
                                ->join('roles', 'personas.codRol', 'roles.codRol')
                                ->where('personas.codPersona', Auth::user()->codPersona)->first();
                $codRol = $rol->codRol;
            }
            return $codRol;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function ViOpciones($codRol) {
        try {
            if (Auth::check()) {
                return DB::table('funciones')
                                ->join('opciones', 'funciones.codOpcion', '=', 'opciones.codOpcion')
                                ->join('menus', 'opciones.codMenu', 'menus.codMenu')
                                ->join('roles', 'funciones.codRol', '=', 'roles.codRol')
                                ->where('funciones.codRol', '=', $codRol)
                                ->get();
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function ViopcionesXUrl($codRol, $urlActual) {
        try {

            if (Auth::check()) {
                return DB::table('funciones')
                                ->join('opciones', 'funciones.codOpcion', '=', 'opciones.codOpcion')
                                ->join('menus', 'opciones.codMenu', 'menus.codMenu')
                                ->join('roles', 'funciones.codRol', '=', 'roles.codRol')
                                ->where('funciones.codRol', '=', $codRol)
                                ->where('opciones.urlWeb', '=', $urlActual)
                                ->get();
            }
        } catch (Exception $e) {
            return false;
        }
    }

}
