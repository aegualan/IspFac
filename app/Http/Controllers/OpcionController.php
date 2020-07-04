<?php

namespace App\Http\Controllers;

use App\Opcion;
use Illuminate\Http\Request;

class OpcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax) {
            $opciones = Opcion::where('codMenu', '1')->orderBy('ordOpcion', 'asc')->get();
            return response()->json($opciones);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            //  $opcion            = new Opcion();
            //$opcion->nomOpcion = $request->nomOpcion;
            // $opcion->ordOpcion = $request->ordOpcion;
            //$opcion->urlWeb    = $request->urlWeb;
            //$opcion->urlAPP    = $request->urlAPP;
            //$opcion->codMenu   = $request->codMenu;
            //$opcion->save();
            Opcion::create($request->all());
            //return response()->json($request->all());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        return datatables()->collection(Opcion::where('codMenu', $id)->orderBy('ordOpcion', 'asc')->get())->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Opcion::find($id));
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
        if ($request->ajax()) {
            $opcion = Opcion::find($id);
            $opcion->fill($request->all());
            $opcion->save();

        }
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

    public function mostrarOpciones(Request $request)
    {
        if ($request->ajax()) {
            return \Utilitarios::getMenuOpciones();
        } else {
            return redirect('/home');
        }
    }
}
