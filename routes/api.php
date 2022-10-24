<?php

use App\Modules\ApiClientes;
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

Route::get('/clientes', [ApiClientes::class, 'list']);
Route::post('/clientes', [ApiClientes::class, 'store']);
Route::get('/clientes/show/{id}', [ApiClientes::class, 'show']);
Route::put('/clientes/update/{id}', [ApiClientes::class, 'update']);
Route::delete('/clientes/delete/{id}', [ApiClientes::class, 'delete']);
