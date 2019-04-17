<?php

namespace App\Http\Controllers;

use App\User_Son;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class UserSonController extends Controller
{
    //Consulta todos los usuarios invitados del usuario 
    public function index($id_admin){
        $types = DB::table('user__sons')
             ->whereIn('id_admin', [$id_admin])
             ->get();
        return response()->json($types);
        }
    //POST api/guest/login: Realiza la autenticación, retorna el token
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $error = 'Usuario o contraseña invalidaaaa';
                
                return response()->json(array(
                    'ERROR'   =>  $error
                ), 401);
            }
        } catch (JWTException $e) {
                $error = 'No se pudo crear el token';
            return response()->json(compact($error), 500);
        }
        return response()->json(compact('token'),201);
    }
    //POST api/register: registra un nuevo usuario, retorna el token
    public function register(Request $request)
    { 
            $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'telephone' => 'required|integer|max:99999999',
            'state' => 'required|string|max:10',
            'type' => 'required|integer|max:10',
            'id_admin' => 'required|integer|max:255',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User_Son::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'telephone' => $request->get('telephone'),
            'state' => $request->get('state'),
            'type' => $request->get('type'),
            'id_admin' => $request->get('id_admin'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }
    //GET API/guest/user: retorna los datos del usuario autenticado
    public function getAuthenticatedUser()
        {
                try {

                        if (! $user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['Usuario no encontrado'], 404);
                        }

                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                        return response()->json(['Token expirado'], 403);

                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                        //return response()->json(['Token invalido'], 403);
                        $error = 'Token invalido';
                        return response()->json(array(
                            'ERROR'   =>  $error
                        ), 403);

                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                        return response()->json(['Falta incluir un token'], 401);

                }

                return response()->json(compact('user'));
        }   
}
