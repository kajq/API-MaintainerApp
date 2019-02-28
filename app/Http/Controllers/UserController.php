<?php

    namespace App\Http\Controllers;

    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

    class UserController extends Controller
    {
        public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    $error = 'Usuario o contraseña invalidaaaa';
                    //return response()->json(compact('error'));
                    return response()->json(array(
                        'ERROR'   =>  $error
                    ), 403);
                }
            } catch (JWTException $e) {
                    $error = 'No se pudo crear el token';
                return response()->json(compact($error));
            }

            return response()->json(compact('token'));
        }

        public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'birthdate' => 'required|string|max:255',
                'telephone' => 'required|integer|max:99999999',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'name' => $request->get('name'),
                'lastname' => $request->get('lastname'),
                'country' => $request->get('country'),
                'birthdate' => $request->get('birthdate'),
                'telephone' => $request->get('telephone'),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user','token'),201);
        }

        public function getAuthenticatedUser()
            {
                    try {

                            if (! $user = JWTAuth::parseToken()->authenticate()) {
                                    return response()->json(['Usuario no encontrado'], 404);
                            }

                    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                            return response()->json(['Token expirado'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                            return response()->json(['Token invalido'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                            return response()->json(['Falta incluir un token'], $e->getStatusCode());

                    }

                    return response()->json(compact('user'));
            }
    }