<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //Request $request;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Utilitarios::accesoPermitido()) {
            //  $datos["clientes"] = Persona::all();
            return view('persona.clientes');
        } else {
            return \Utilitarios::sacarSistema();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //if (\Utilitarios::accesoPermitido()) {
        if ($request->ajax()) {
            return datatables()->collection(Persona::where('codRol', 'CLI')->get())->toJson();
        } else {
            return redirect('/home');
            // return datatables()->collection(Persona::where('codRol', 'CLI')->get())->toJson();
        }

        //}
        //return response()->json(Persona::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (\Utilitarios::accesoPermitido()) {
        if ($request->ajax()) {
            Persona::create($request->all());

        }else{
             return redirect('/home');
        }
        //  }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // if (\Utilitarios::accesoPermitido()) {
        if ($request->ajax()) {
            $persona = Persona::find($id);
            return response()->json($persona);
        } else {
            return redirect('/home');
        }

        // }
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
        //  if (\Utilitarios::accesoPermitido()) {
        if ($request->ajax()) {
            $persona = Persona::find($id);
            $persona->fill($request->all());
            $persona->save();

        }else{
             return redirect('/home');
        }
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
