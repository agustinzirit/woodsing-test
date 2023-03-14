<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function inicio() {

        $user = auth()->user();

        if ($user->role_id == 1 && request()->ip() == '127.0.0.1'){
            $cookie = cookie('origin_sesion', 'Usuario con rol 1 e IP local host', 30);
        }else{
            $cookie = cookie('origin_sesion', 'Bienvenido ' . $user->fullName(), 30);
        }

        return response()->view('home')->withCookie($cookie);
    }

    public function dobleFactor($datos) {
        // $datos = request()->all();
        $datos = base64_decode($datos);
        // $datos = json_decode($datos, true);

        $numero = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);

        $cookie = cookie("doble_factor", $numero, 30);

        $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format("svg")->size(200)->color(0,0,0)->generate($numero);

        return response()->view("segundo-factor", compact('qr', 'datos'))->withCookie($cookie);
    }

    public function sesiones () {
        return response()->view("sesiones");
    }

    public function verificacion () {
        return response()->view("verificacion");
    }

    public function verificacionEmail() {
        $existe = Usuarios::where('correo', request()->input('correo'))->exists();

        if ($existe) {
            Usuarios::where('id', auth()->user()->id)->update(['email_verified_at' => Carbon::now()]);

            return redirect()->route('inicio')->with('correo', 'Correo verificado');
        }else {
            return redirect()->route('inicio')->with('correo', 'Correo erroneo, verifique de nuevo');
        }
    }

    public function verificarDobleFactor() {
        $datos = request()->all();

        if ($datos['codigo'] == request()->cookie("doble_factor")) {
            $login = json_decode($datos['datos'], true);

            if (auth()->attempt($login)) {
                return redirect()->intended('inicio')->withSuccess('Signed in');
            }
        }

        return redirect()->route('sesiones');
    }
}
