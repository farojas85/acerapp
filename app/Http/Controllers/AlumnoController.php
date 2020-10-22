<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Registro;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::paginate(10);
        return view('alumno.inicio',compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumno.create');
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
            'CODE_A' =>'required|digits:10',
            'DNI_A' => 'required|digits:8',
            'APP_A' => 'required|string|max:30',
            "APM_A"  => "required|string|max:30",
            'NOM_A' => 'required|string|max:50',
            'CEL_A' => 'required|digits:9|starts_with:9',
            'ESC_A' => 'required|string|max:100',
            'DIR_A' => 'required|string',
            'DIS_A' => 'required|string|max:20'
        ];

        $mensaje=[
            'starts_with' => 'El  Nro. de Celular debe comensar con :values',
            'required' => '* Campo Obligatorio',
            'digits' => 'Ingrese número de :digits dígitos',
            'max' =>'Ingrese Máximo :max caracteres o dígitos',
            'string' => 'Ingrese Cadena de Caracteres'
        ];

        $this->validate($request,$reglas,$mensaje);

        $alumno = new Alumno();
        $alumno->CODE_A = $request->CODE_A;
        $alumno->DNI_A = $request->DNI_A;
        $alumno->PSW_A = rand(1000,9000);
        $alumno->APP_A = $request->APP_A;
        $alumno->APM_A = $request->APM_A;
        $alumno->NOM_A = $request->NOM_A;
        $alumno->CEL_A = $request->CEL_A;
        $alumno->ESC_A = $request->ESC_A;
        $alumno->DIR_A = $request->DIR_A;
        $alumno->DIS_A = $request->DIS_A;
        $alumno->save();

        return response()->json([
            'ok' => 1,
            'alumno' => $alumno
        ]);
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
    public function edit($COD_A)
    {
        $alumno  = Alumno::where('COD_A',$COD_A)->first();
        return view("alumno.edit",compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reglas = [
            'CODE_A' =>'required|digits:10',
            'DNI_A' => 'required|digits:8',
            'APP_A' => 'required|string|max:30',
            "APM_A"  => "required|string|max:30",
            'NOM_A' => 'required|string|max:50',
            'CEL_A' => 'required|digits:9|starts_with:9',
            'ESC_A' => 'required|string|max:100',
            'DIR_A' => 'required|string',
            'DIS_A' => 'required|string|max:20'
        ];

        $mensaje=[
            'starts_with' => 'El  Nro. de Celular debe comensar con :values',
            'required' => '* Campo Obligatorio',
            'digits' => 'Ingrese número de :digits dígitos',
            'max' =>'Ingrese Máximo :max caracteres o dígitos',
            'string' => 'Ingrese Cadena de Caracteres'
        ];

        $this->validate($request,$reglas,$mensaje);

        $alumno = Alumno::where('COD_A',$request->COD_A)->first();

        $alumno->CODE_A = $request->CODE_A;
        $alumno->DNI_A = $request->DNI_A;
        $alumno->PSW_A = $request->PSW_A;
        $alumno->APP_A = $request->APP_A;
        $alumno->APM_A = $request->APM_A;
        $alumno->NOM_A = $request->NOM_A;
        $alumno->CEL_A = $request->CEL_A;
        $alumno->ESC_A = $request->ESC_A;
        $alumno->DIR_A = $request->DIR_A;
        $alumno->DIS_A = $request->DIS_A;
        $alumno->save();

        return response()->json([
            'ok' => 1,
            'alumno' => $alumno
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $registro = Registro::where('COD_A',$alumno->COD_A)->count();
        if($registro>0)
        {
            return response()->json([
                'ok' => '0',
                'mensaje' => 'No se eliminará al Alumno porque tiene registro de entregas de Raciones'
            ]);
        }
        $alumno->delete();
        return response()->json([
            'ok' =>1,
            'alumno' =>$alumno
        ]);
    }
}
