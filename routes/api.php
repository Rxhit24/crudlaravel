<?php

use App\Http\Controllers\ProfileQuestionController;
use App\Http\Controllers\QualificatioControllern;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TokenController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students',[StudentController::class, 'index']);
Route::post('/students',[StudentController::class, 'store']);
Route::post('/qualification',[QualificatioControllern::class, 'store']);
Route::get('/students/{id}',[StudentController::class, 'findStudent']);
Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
Route::put('/students/{id}/edit', [StudentController::class, 'update']);
Route::delete('/students/{id}/delete', [StudentController::class, 'delete']);
Route::post('/questionset', [ProfileQuestionController::class, 'storeQuestionSet']);
Route::get('/questionset', [ProfileQuestionController::class, 'getQuestionSet']);

Route::post('/student/apiKey',[TokenController::class, 'generate']);
Route::middleware('api_token')->group(function () {

    Route::post('/student/list',[StudentController::class, 'index']);
    // Route::get('/supplier/list',[SupplierController::class,'getSupplierList']);

    // Route::get('/supplier/live_projects', [ProjectsController::class,'getLiveProjects']);

    // Route::get('/supplier/accepted_projects', [SurveyController::class, 'addVendor']);

    // Route::get('/supplier/paused_projects', function (Request $request) {
    //     // Logic to fetch and return paused projects of supplier
    // });

    // Route::get('/supplier/closed_projects', function (Request $request) {
    //     // Logic to fetch and return closed projects of supplier
    // });
});