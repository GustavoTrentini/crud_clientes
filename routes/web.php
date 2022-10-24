<?php

use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::get('/clientes/show/{id}', [ClientesController::class, 'show'])->name('clientes.show');
Route::get('/clientes/edit/{id}', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::post('/clientes/store', [ClientesController::class, 'store'])->name('clientes.store');
Route::put('/clientes/update/{id}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/delete/{id}', [ClientesController::class, 'delete'])->name('clientes.delete');
