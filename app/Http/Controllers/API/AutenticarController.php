<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistroRequest;
use App\Http\Requests\AccesoRequest;
use Illuminate\Support\Facades\hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\CerrarSesionRequest;
use Illuminate\Http\Request;

class AutenticarController extends Controller
{
    //
    public function registro(RegistroRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email= $request->email;
        $user->password= bcrypt($request->password);

        $user->save();
        return response()->json([
            'res'=>true,
            'msg'=> 'usuario registrado correctamente'
        ],200);
    }

    public function acceso(AccesoRequest $request){
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {//cuando no exista el usuario o las contraseñas sean incorrectas
            throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas'],
            ]);
        }
     
        $token = $user->createToken($request->email)->plainTextToken; //crea token y se lo da a un usuario
        return response()->json([
            'res'=> true,
            'token'=>$token
        ],200);
    }

    public function cerrarSesion(Request $request){
        $request->user()->currentAccessToken()->delete(); 
        return response()->json([
            'res'=>true,
            'msg'=> 'Token Eliminado Correctamente'
        ],200);
    }
}
