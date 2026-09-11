<?php

use App\Http\Controllers\Web\MakananFavoritController;
use App\Http\Controllers\Web\MantanTerindahController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/mantan');

Route::resource('mantan', MantanTerindahController::class);
Route::resource('makanan-favorit', MakananFavoritController::class);

