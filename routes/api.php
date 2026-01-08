<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\RifaController;

//******************************************************//
Route::POST('/login', [LoginController::class, 'login']);
//******************************************************//


//**************************************************************************************//
Route::POST('/estudio/crear-estudio', [EstudioController::class,'CrearEstudio']);
Route::POST('/estudio/mostrar-estudio', [EstudioController::class,'MostrarEstudios']);
Route::POST('/estudio/datos-estudio', [EstudioController::class,'MostrarDatosEstudios']);
Route::POST('/estudio/eliminar-estudio', [EstudioController::class,'EliminarEstudio']);
//**************************************************************************************//

//**************************************************************************************//
Route::POST('/estudio/mostrar-boletos', [RifaController::class,'MostrarBoletos']);
Route::POST('/estudio/guardar-boleto', [RifaController::class,'GuardarBoletos']);
Route::POST('/estudio/editar-boleto', [RifaController::class,'EditarBoleto']);
Route::POST('/estudio/no-ganador-boleto', [RifaController::class,'NoGanadorBoleto']);
//**************************************************************************************//