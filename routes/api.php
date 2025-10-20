<?php

use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\UserController;
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
// not work show method
// Route::apiResource('/technologies', TechnologyController::class)
//     ->only(['index', 'show'])
//     ->parameter('technologies', 'technology ');

Route::get('/technologies', [TechnologyController::class, 'index']);
Route::get('/technologies/{technology}', [TechnologyController::class, 'show']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/trainings', [TrainingController::class, 'index']);
Route::get('/trainings/{training}', [TrainingController::class, 'show']);
