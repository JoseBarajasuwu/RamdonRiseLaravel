<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudioController extends Controller
{
    public function CrearEstudio(Request $request)
    {
        $UsuarioID = $request->UsuarioID;
        $NombreCasino = $request->NombreCasino;
        $SobreNombre = $request->SobreNombre;
        $FechaRegistro = $request->FechaRegistro;
        $json = $request->Numeros;
        // Función para corregir el formato JSON

        try {
            DB::insert('INSERT INTO "Estudio" ("UsuarioID","NombreCasino", "SobreNombre", "FechaRegistro") VALUES(?,?,?,?)', [$UsuarioID, $NombreCasino, $SobreNombre, $FechaRegistro]);
            $EstudioID = DB::select('SELECT 
                                        "EstudioID"
                                    FROM "Estudio"
                                    WHERE
                                        "UsuarioID" = ?
                                    AND "NombreCasino" = ?
                                    AND "SobreNombre" = ?', [$UsuarioID, $NombreCasino, $SobreNombre])[0]->EstudioID;
            if (!empty($EstudioID)) {
                function fix_json($json)
                {
                    // Poner comillas dobles alrededor de las claves
                    $json = preg_replace('/(\w+):/', '"\1":', $json);
                    // Poner comillas dobles alrededor de los valores de color
                    $json = preg_replace('/:\s*({\s*[^}]*\s*)/', ': \1', $json);
                    return $json;
                }

                $fixed_json = fix_json($json);

                // Decodificar el JSON corregido a un array asociativo
                $data = json_decode($fixed_json, true);

                // Verificar si json_decode fue exitoso
                if (json_last_error() !== JSON_ERROR_NONE) {
                    die('Error en la decodificación JSON: ' . json_last_error_msg());
                }

                // echo json_encode($data);
                foreach ($data as $key => $value) {
                    DB::insert(
                        'INSERT INTO "EstudioDetalle" ("EstudioID", "Numero", "Rojo", "Negro", "Verde") VALUES (?, ?, ?, ?, ?)',
                        [$EstudioID, $value["Numero"], $value["Red"], $value["Black"], $value["Green"]]
                    );
                    // echo $value["Numero"] . " - " . $value["Red"] . " - " . $value["Black"] . " - " . $value["Green"] . "\n";
                }

                $Estudio = array("EstudioID" => $EstudioID);
                return $Estudio;
            } else {
                return "0";
            }
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }
    public function MostrarEstudios(Request $request)
    {
        $UsuarioID = $request->UsuarioID;
        try {
            $Estudio = DB::select('SELECT
                                        "EstudioID"
                                        ,"NombreCasino"
                                        ,"SobreNombre"
                                        ,"FechaRegistro"
                                    FROM "Estudio"
                                    WHERE "UsuarioID" = ? 
                                    AND "Estatus" = ?', [$UsuarioID, 1]);
            return $Estudio;
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }
    public function MostrarDatosEstudios(Request $request)
    {
        $EstudioID = $request->EstudioID;
        $resultados = [];
        try {
            $Datos = DB::select('SELECT 
                                "EstudioDetalleID"
                                ,"Numero"
                                ,"Rojo"
                                ,"Negro"
                                ,"Verde"
                            FROM
                                "EstudioDetalle"
                            WHERE "EstudioID" = ?', [$EstudioID]);

            $total = 0;
            foreach ($Datos as $item) {
                $EstudioDetalleID = $item->EstudioDetalleID;
                $Numero = $item->Numero;
                $total = $item->Rojo + $item->Negro + $item->Verde;
                $Rojo = round(($item->Rojo / $total) * 100, 2);
                $Negro = round(($item->Negro / $total) * 100, 2);
                $Verde = round(($item->Verde / $total) * 100, 2);

                $resultados[] = array(
                    "EstudioDetalleID" => $EstudioDetalleID,
                    "Numero" => $Numero,
                    "Rojo" => $Rojo,
                    "Negro" => $Negro,
                    "Verde" => $Verde

                );
            }
            return $resultados;
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }
    public function EliminarEstudio(Request $request)
    {
        $EstudioID = $request->EstudioID;
        try {
            DB::delete('DELETE FROM "EstudioDetalle" WHERE "EstudioID" = ?', [$EstudioID]);
            DB::delete('DELETE FROM "Estudio" WHERE "EstudioID" = ?', [$EstudioID]);
            return "1";
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }
}
