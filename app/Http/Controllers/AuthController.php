<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Validator;

class AuthController extends Controller
{
    public function loginForm() {
        $msg = '';
        return view( 'auth.login', compact('msg') );
    }

    public function loginPost( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'num_identificacion' => 'required|min:3',
            'password' => 'required|min:3',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'success' => false, 'errors' => $validator->errors() ] );
        }


        if ( Auth::attempt( [ 'tipo' => $request->tipo, 'num_identificacion' => $request->num_identificacion, 'password' => $request->password ]) ) {
            return redirect('/home');
        } else {
            $msg = "Los datos de inicio de sesión son incorrectos, por favor vuelve a intentarlo";
            return redirect('/')->with('msg', $msg);
        }
    }

    public function apiLoginPost( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'num_identificacion' => 'required|min:3',
            'password' => 'required|min:3',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'success' => false, 'errors' => $validator->errors() ] );
        }


        if ( Auth::attempt( [ 'tipo' => $request->tipo, 'num_identificacion' => $request->num_identificacion, 'password' => $request->password ]) ) {
            
            $user = \App\Models\User::find(auth()->user()->id);
            $token = $user->createToken('my-app-token')->plainTextToken;

            $user->fill([
                'remember_token' => $token
            ]);
            $user->save();

            return response()->json([
                'status' => true,
                'usuario' => $user,
                'token' => $user->remember_token
            ]);
        } else {
            return response()->json([
                'status' => false,
                'usuario' => null
            ]);
        }
    }

    public function logoutGet() {

        Auth::logout();

        return redirect( '/' );
    }

    public function apiLogoutPost() {

        Auth::logout();

        return response()->json([
            'status' => true,
            'usuario' => null
        ]);
    }

    public function logoutPost() {

        Auth::logout();

        return redirect( '/' );
    }
}