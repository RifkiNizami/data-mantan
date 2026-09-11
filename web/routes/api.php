<?php

use App\Http\Controllers\Api\MakananFavoritController;
use App\Http\Controllers\Api\MantanTerindahController;
use Illuminate\Support\Facades\Route;

Route::apiResource('mantan', MantanTerindahController::class)->names('api.mantan');
Route::apiResource('makanan-favorit', MakananFavoritController::class)->names('api.makanan-favorit');

