<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;


use App\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function signup(Request $request)
    {

        //return var_dump($request->all());

        //recibimos los parametros enviados pos post
        $validator = \Validator::make($request->all(),
            //Arreglo de validaciones
            [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
            //Arreglo de respuestas a validaciones
            [
                'name.required' => 'El nombre es requerido',
                'name.max' => 'Excedio el limite de caracteres',
                'email.email' => 'El email es invalido'
            ]);

        //si alguno es invalido retornamos los errores en la peticion
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->save();

        return response()->json([
            'message' => 'El usuario se creo correctamente'
        ], 201);
    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();  //retorna el objeto si se encuentra el email

        //valida que si se encuentre el email
        if ($user) {
            //verifica la contraseña hasheada de la bd con la contraseña pasada en el request
            if (Hash::check($request->password, $user->password)) {

                //La funcion createToken es propia de laravel passport implementada en el modelo
                $token = $user->createToken('Esto es un token')->accessToken;

                return response()->json([
                    'token' => $token
                ]);
            } else {

                return response()->json([
                    'error' => 'Password o Email son incorrectos'
                ], 422);
            }
        } else {
            return response()->json([
                'error' => 'Password o Email son incorrectos'
            ], 422);
        }

    }

}
