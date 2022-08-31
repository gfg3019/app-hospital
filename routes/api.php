<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/paciente/store', [App\Http\Controllers\PacienteController::class, 'store'])->name('paciente.store');
Route::get('/paciente/show/{id}', [App\Http\Controllers\PacienteController::class, 'show'])->name('paciente.show');

Route::post('/endereco', [App\Http\Controllers\EnderecoController::class, 'saveEndereco']);
Route::get('/endereco/{id}', [App\Http\Controllers\EnderecoController::class, 'exibiEndereco']);
Route::get('/endereco', [App\Http\Controllers\EnderecoController::class, 'exibiEndereco']);
Route::get('/endereco', [App\Http\Controllers\EnderecoController::class, 'exibiEnderecoAll']);
