<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DeploymentCheckController;

Route::apiResource('projects', ProjectController::class)->only(['index', 'store']);
Route::get('/projects/{project}/readiness', [ProjectController::class, 'readiness']);

Route::post('/projects/{project}/checks', [DeploymentCheckController::class, 'store']);
Route::patch('/checks/{check}/complete', [DeploymentCheckController::class, 'complete']);
