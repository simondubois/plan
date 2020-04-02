<?php

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

Route::apiResource('projects', ProjectController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy']);

Route::apiResource('tasks', TaskController::class)
    ->only(['index', 'store', 'show']);
