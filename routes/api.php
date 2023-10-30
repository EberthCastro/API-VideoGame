<?php

use App\Http\Controllers\SkinController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/skins/available', [SkinController::class, 'getAvailableSkins' ]);
Route::post('/skins/buy', [SkinController::class, 'store' ]);
Route::get('/skins/myskins', [SkinController::class, 'index' ]);
Route::put('/skins/color/{id}', [SkinController::class, 'update' ]);
Route::delete('/skins/delete/{id}', [SkinController::class, 'destroy' ]);
Route::get('/skin/getskin/{id}', [SkinController::class, 'show' ]);
