<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\OndaController;
use App\Http\Controllers\BateriaController;
use App\Http\Controllers\SurfistaController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResources([
    'surfista' => SurfistaController::class,
    'bateria' => BateriaController::class,
    'onda' => OndaController::class,
    'nota' => NotaController::class,
]);

