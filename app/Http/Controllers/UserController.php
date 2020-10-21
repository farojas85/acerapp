<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('usuario.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->moto_user;

        $reglas = [
            'dni_user' =>'required|max:8',
            'apellido_paterno' => 'required|string|max:191',
            'apellido_materno' => 'required|string|max:191',
            "nombres"  => "required|string|max:191",
            'name' => 'required|string',
            'password' => 'required',
            'password_repeat' => 'required|same:password',
            //'email' => 'email'
        ];

        $mensaje=[
            'required' => '* Campo Obligatorio',
            'max' =>'Ingrese Máximo 8 dígitos',
            'min' => '* Debe Seleccionar al menos 1 ración',
            'exists' => 'Codigo Estudiante no existe',
            'same' => 'Las Contraseña deben coincidir',
            //'email' => 'Correo No Valido: example@.com'
        ];

        $this->validate($request,$reglas,$mensaje);

        $user = new User();
        $user->dni_user = $request->dni_user;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->nombres = $request->nombres;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->moto_user = ($request->moto_user) ? 1 : 0;
        $user->save();

        return response()->json([
            'ok' => 1,
            'usuario' => $user
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
    public function edit($id)
    {
        $usuario  = User::where('id',$id)->first();
        return view("usuario.edit",compact('usuario'));
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
        $user = User::where('id',$request->id)->first();

        $user->dni_user = $request->dni_user;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->nombres = $request->nombres;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->moto_user = ($request->moto_user=='on') ? 1 : 0;
        $user->save();

        return response()->json([
            'ok' => 1,
            'usuario' => $user
        ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $registro = Registro::where('COD_USR',$usuario->id)->count();
        if($registro>0)
        {
            return response()->json([
                'ok' => '0',
                'mensaje' => 'No se eliminará al Usuario porque tiene registro de entregas de Raciones'
            ]);
        }
        $usuario->delete();
        return response()->json([
            'ok' =>1,
            'usario' =>$usuario
        ]);
    }
}
