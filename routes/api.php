<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// usar somente quando for fazer a autenticação
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('funcionarios', FuncionarioController::class);
Route::apiResource('departamentos', DepartamentoController::class);
