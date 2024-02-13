<?php

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

Route::get('consulta/cnpj/{cnpj}', function ($cnpj) {
    return \Illuminate\Support\Facades\Http::get('https://receitaws.com.br/v1/cnpj/' . $cnpj);
});
