<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){
        $userData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $userData['password'] = bcrypt($userData['password']);

        $mensaje = "Usuario y/o contraseña incorrectos";
        $mensaje2 = "Usuario logeado correctamente";

        if(!Auth::attempt($userData)){
            return response()->json(["Mensaje"=>$mensaje]);
        }
        return response()->json(["Mensaje"=>$mensaje2]);
    }
}
