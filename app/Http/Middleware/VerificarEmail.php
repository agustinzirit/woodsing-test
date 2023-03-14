<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class VerificarEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check() == false) {
            return redirect()->route("registrar");
        }else{
            $usuario = DB::table("usuarios")->where("correo", auth()->user()->correo)->first();

            if ($usuario->email_verified_at === null) {
                return redirect()->route("verificacion");
            }else{
                // $pass = Hash::check($request->password, $usuario->password);

                // if ($pass){
                    if ($usuario->ultima_sesion != null) {
                        $ultimaSesion = new Carbon($usuario->ultima_sesion);
                        $hoy = Carbon::now();
                        $transcurrido = $ultimaSesion->diff($hoy);

                        DB::table('usuarios')->where("id", $usuario->id)->update(["ultima_sesion" => Carbon::now()]);

                        if ($transcurrido->hours > 24 || $transcurrido->days > 0) {
                            return redirect()->route("sesiones");
                        }
                    }
                // }

                return $next($request);
            }
        }
    }
}
