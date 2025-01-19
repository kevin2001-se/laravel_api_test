<?php

namespace App\Http\Controllers;

use App\Mail\RecoverPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);

        // Crear token
        $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales de usuario incorrectas.'
            ], 401);
        }

        // Crear token
        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cerrastes Sesión.'
        ], 201);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function recover_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'El email ingresado no existe.'
            ], 401);
        }

        // Generar nueva contraseña
        $password = $this->generarPasswordSegura(12);

        // Actualizar contraseña
        $user->update([
            'password' => Hash::make($password)
        ]);

        // Enviar correo con la nueva contraseña
        $response = Mail::to($request->email)->send(new RecoverPassword($user, $password));

        return response()->json([
            'success' => true,
            'message' => 'Correo enviado correctamente.',
            'mail' =>  $response
        ], 201);
    }

    public function generarPasswordSegura($longitud = 12) {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $longitud; $i++) {
            $password .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }
        return $password;
    }
}
