<?php

use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
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

Route::apiResource('/projects', ProjectController::class)
    ->only(['index', 'show', 'store'])
    ->parameter('projects', 'project');

Route::apiResource('/experiences', ExperienceController::class)
    ->only(['index', 'show'])
    ->parameter('experiences', 'experience');

Route::apiResource('/technologies', TechnologyController::class)
    ->only(['index', 'show'])
    ->parameter('technologies', 'technology ');