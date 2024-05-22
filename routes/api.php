<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstudioController;

//******************************************************//
Route::POST('/login', [LoginController::class, 'login']);
//******************************************************//


//**************************************************************************************//
Route::POST('/estudio/crear-estudio', [EstudioController::class,'CrearEstudio']);
Route::POST('/estudio/mostrar-estudio', [EstudioController::class,'MostrarEstudios']);
Route::POST('/estudio/datos-estudio', [EstudioController::class,'MostrarDatosEstudios']);
Route::POST('/estudio/eliminar-estudio', [EstudioController::class,'EliminarEstudio']);
//**************************************************************************************//