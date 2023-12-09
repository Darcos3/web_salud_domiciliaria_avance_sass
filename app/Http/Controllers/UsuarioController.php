<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Paciente;
use \App\Models\Profesional;
use Hash;

class UsuarioController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \App\Models\User::create([
            'num_identificacion' => $request->num_identificacion,
            'correo_electronico' => $request->correo_electronico,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            'estado' => 0
        ]);
        $user->save();
        
        if( $user->tipo == 1 ){

            $paciente = \App\Models\Paciente::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $paciente->save();
        }else {

            $profesional = \App\Models\Profesional::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $profesional->save();
        }

        return response()->json([
            'status' => true,
            'user' => $user->id,
            'message' => 'Se ha creado el usuario '.$user->id,
        ]);
    }


    public function registro(){
        return view('auth.register');
    }

    public function registrar( Request $request){
        $user = \App\Models\User::create([
            'num_identificacion' => $request->num_identificacion,
            'correo_electronico' => $request->correo_electronico,
            'usuario' => $request->nombres.$request->apellidos,
            'password' => Hash::make($request->num_identificacion),
            'tipo' => $request->tipo,
            'estado' => 0
        ]);
        $user->save();
        
        if( $user->tipo == 1 ){

            $paciente = \App\Models\Paciente::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $paciente->save();
        }else {

            $profesional = \App\Models\Profesional::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $profesional->save();
        }

        $msg = 'El usuario ha sido registrado exitosamente, ahora por favor inicia sesión!';

        return redirect('/')->with('msg', $msg);
    }

    public function updatePassword(){
        return view('auth.update-password');
    }

    public function guardarPassword(Request $request, User $usuario){
        $usuario->fill([
            'password' => Hash::make($request->password),
            'estado' => 1
        ]);
        $usuario->save();

        return redirect('/home');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // dd($user);

        if( $user->tipo == 1 ){
            $rol = Paciente::where('user_id', '=', $user->id)->get()->first();
        }else {
            $rol = Profesional::where('user_id', '=', $user->id)->get()->first();
        }
        return view('configuracion.edit', compact('user','rol'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill([
            'correo_electronico' => $request->correo_electronico,
            'usuario' => $request->usuario,
        ]);
        $user->save();
        
        if($request->password != null){
            $user->fill([
                'password' => Hash::make($request->password)
            ]);
            $user->save();
        }

        if( $user->tipo == 1 ){
            $paciente = Paciente::where('user_id', '=', $user->id)->get()->first();

            $paciente->fill([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $paciente->save();
        }else {
            $profesional = Profesional::where('user_id', '=', $user->id)->get()->first();

            $profesional->fill([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $profesional->save();
        }

        $msg = 'Se ha actualizado tu perfil exitosamente';

        return redirect('/configuracion/'.auth()->user()->id.'?msg='.$msg);
    }


    public function apiRegistrar( Request $request){

        $usuario = \App\Models\User::where('num_identificacion', '=', $request->num_identificacion)->get()->first();

        if( $usuario == null){
            $user = \App\Models\User::create([
                'num_identificacion' => $request->num_identificacion,
                'correo_electronico' => $request->correo_electronico,
                'usuario' => $request->nombre.'_'.$request->apellidos,
                'password' => Hash::make($request->num_identificacion),
                'tipo' => $request->tipo,
                'estado' => 0
            ]);
            $user->save();
            
            if( $user->tipo == 1 ){
    
                $rol = \App\Models\Paciente::create([
                    'user_id' => $user->id,
                    'nombre' => $request->nombre,
                    'apellidos' => $request->apellidos,
                    'correo_electronico' => $request->correo_electronico,
                    'num_celular' => $request->num_celular,
                    'ubicacion' => $request->ubicacion
                ]);
                $rol->save();
            }else {
                $rol = \App\Models\Profesional::create([
                    'user_id' => $user->id,
                    'nombre' => $request->nombre,
                    'apellidos' => $request->apellidos,
                    'correo_electronico' => $request->correo_electronico,
                    'num_celular' => $request->num_celular,
                    'ubicacion' => $request->ubicacion
                ]);
                $rol->save();
            }

            return response()->json([
                'status' => true,
                'usuario' => $user,
                'rol' => $rol
            ]);
    
        }else {
            return response()->json([
                'status' => false,
                'usuario' => null,
                'rol' => null
            ]);
        }
    }

    public function apiObtenerUsuario(Request $request){
        $id = $request->usuario;

        $usuario = User::find($id);
        if($usuario->tipo == 0){
            $rol = \App\Models\Profesional::where('user_id', '=', $id)->get()->first();
        }
        else {
            $rol = \App\Models\Paciente::where('user_id', '=', $id)->get()->first();
        }

        return response()->json([
            'status' => true,
            'usuario' => $usuario,
            'rol' => $rol
        ]);
    }

    public function apiUpdate(Request $request)
    {
        $id = $request->id;

        $user = \App\Models\User::find($id);

        $user->fill([
            'correo_electronico' => $request->correo_electronico,
            'usuario' => $request->usuario,
        ]);
        $user->save();

        if( $user->tipo == 1 ){
            $paciente = Paciente::where('user_id', '=', $user->id)->get()->first();

            $paciente->fill([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $paciente->save();
        }else {
            $profesional = Profesional::where('user_id', '=', $user->id)->get()->first();

            $profesional->fill([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo_electronico' => $request->correo_electronico,
                'num_celular' => $request->num_celular,
                'ubicacion' => $request->ubicacion
            ]);
            $profesional->save();
        }

        return response()->json([
            'status' => true,
            'usuario' => $user,
        ]);

    }

    public function apiGuardarPassword(Request $request){
        $id = $request->usuario;

        $user = \App\Models\User::find($id);

        $user->fill([
            'password' => Hash::make($request->password),
            'estado' => 1
        ]);
        $user->save();

        return response()->json([
            'status' => true,
            'usuario' => $user,
        ]);
    }

}
