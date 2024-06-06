<?php

use App\Http\Controllers\ConcertController;
use Illuminate\Support\Facades\Route;

Route::get('concert/{id}', [ConcertController::class, 'getById']);
Route::get('concerts/city/{id}', [ConcertController::class, 'getAllByCityId']);
Route::get('concerts/singer/{id}', [ConcertController::class, 'getAllBySingerId']);
