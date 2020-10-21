<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Alumno;
use App\Models\Registro;
use App\Models\RegistroDetalle;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Registro::with(['alumno:COD_A,APP_A,APM_A,NOM_A,ESC_A','registro_detalles'])
                        ->orderBy('REG_REG','desc')->paginate(10);
        return view('registro.inicio',compact('registros'));
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
            'code_a' =>'required|exists:App\Models\Alumno,code_a',
            'psw_a' => 'required',
            'racion' => 'required|array|min:1',
            "racion.*"  => "required|string|distinct|min:1",
        ];

        $mensaje=[
            'required' => '* Campo Obligatorio',
            'min' => '* Debe Seleccionar al menos 1 ración',
            'exists' => 'Codigo Estudiante no existe'
        ];

        $this->validate($request,$reglas,$mensaje);

        $alumno = Alumno::select('COD_A','CODE_A','PSW_A')->where('code_a',$request->code_a)
                        ->first();
        if($alumno)
        {
            if($request->psw_a != $alumno->PSW_A)
            {
                $regla =['psw_a' => 'same:$alumno->PSW_A'];
                $mensaje = ['same' => 'Contraseña Incorrecta del Estudiante'];
                $this->validate($request,$regla,$mensaje);
            }
        }

        $registro = new Registro();
        $registro->COD_USR = Auth::user()->id;
        $registro->COD_A = $alumno->COD_A;
        $fecha = Carbon::now();
        $registro->REG_REG = $fecha->format('Y-m-d H:i:s');
        $registro->FECHA_REG = $fecha->format('Y-m-d');
        $registro->HORA_REG = $fecha->format('H:i:s');
        $registro->save();

        $x=0;
        $detalle = "";
        foreach($request->racion as $racion)
        {   $x+=1;
            if($x == count($request->racion))
            {
                $detalle .= $racion;
            } else {
                $detalle .= $racion." - ";
            }
        }

        $detRegistro = new RegistroDetalle();
        $detRegistro->COD_REG = $registro->COD_REG;
        $detRegistro->PROD_DETREG = $detalle;
        $detRegistro->save();

        return response()->json([
            'alumno' => $alumno->COD_A,
            'registro' => $registro->COD_REG
        ]);

    }

    public function mostrarEntrega($alumno, $registro)
    {
        $alumno = Alumno::select('COD_A','CODE_A','PSW_A','APP_A','APM_A','NOM_A','ESC_A')
                        ->where('COD_A',$alumno)
                        ->first();
        $registro = Registro::select('COD_REG','FECHA_REG','HORA_REG')->where('COD_REG',$registro)->first();

        return view('registro.mostrar-registro',compact('alumno','registro'));

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
