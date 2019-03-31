<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

    class JwtMiddleware extends BaseMiddleware
    {

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return response()->json(['Error' => 'Token invalido'],403);
                    
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return response()->json(['Error' => 'Token vencido'],403);
                }else{
                    return response()->json(['Error' => 'Token de autorización no encontrado'],403);
                }
            }
            return $next($request);
        }
    }
