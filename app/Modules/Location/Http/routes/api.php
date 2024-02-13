<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Location\Http\Controllers\LocationController;

Route::get('/states', [LocationController::class, 'states'])->name('index');
Route::get('/states/{uf}/cities', [LocationController::class, 'citiesByUf'])->name('cities_by_uf');
