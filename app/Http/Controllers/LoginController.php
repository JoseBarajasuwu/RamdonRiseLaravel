<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $Password = $request->Pass;
        $NombreUsuario = $request->NombreUs;
        try {
            $usuarios = DB::select('SELECT
            "UsuarioID"
        FROM
            "Usuario"
        WHERE
            "Contrasenia" = ? 
        AND "NombreUsuario" = ?', [$Password, $NombreUsuario]);
            if (!empty($usuarios)) {
                return $usuarios;
            } else {
                $usuarioID [] = array("UsuarioID" => 0);
                return $usuarioID;
            }
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }
}
