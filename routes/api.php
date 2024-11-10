<?php

use App\Http\Controllers\API\PacienteController;
USE App\Http\Controllers\API\AutenticarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//a estas rutas se puede acceder sin token
Route::post('registro',[AutenticarController::class,'registro']);
Route::post('acceso',[AutenticarController::class,'acceso']);

//para tener acceso a las rutas teniendo un token asociado, si no tiene token no vera lo que esta adentro
Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::post('cerrarsesion',[AutenticarController::class,'cerrarSesion']);
    //ruta para ver la data
    Route::apiResource('pacientes',PacienteController::class);
});