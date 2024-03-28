<?php

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

use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;


Route::middleware('auth:sanctum')->group(function () {
    //Authentication
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::post('/logout', [UserController::class, 'logout']);
        
    Route::post('/stories/create', [StoryController::class, 'createStory']);
    Route::post('/category/create', [CategoryController::class, 'createCategory']);
    Route::post('/author/create', [CategoryController::class, 'createAuthor']);

    Route::get('/story/list', [StoryController::class, 'getListStory']);




});



Route::post('/login', [UserController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);

Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
