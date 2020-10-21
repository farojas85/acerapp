<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Registro;
use App\Models\RegistroDetalle;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registro.inicio');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repartidor = Auth::user()->nombres.' '.Auth::user()->apellido_paterno.' '.Auth::user()->apeollido_materno;
        //$repartidor="";
        return view('registro.create',compact('repartidor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'code_a' =>'required',
            'psw_a' => 'required',
            'racion' => 'required|array|min:1',
            "racion.*"  => "required|string|distinct|min:1",
        ];

        $mensaje=[
            'required' => '* Campo Obligatorio',
            'min' => '* Debe Seleccionar al menos 1 ración'
        ];

        $this->validate($request,$reglas,$mensaje);


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
        //
    }
}
