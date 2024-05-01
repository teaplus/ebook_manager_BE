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
use App\Http\Controllers\CommentController;



Route::middleware('auth:sanctum')->group(function () {
    //Authentication
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/stories/{id}', [StoryController::class, 'listChapter']);    
    Route::post('/stories/create', [StoryController::class, 'createStory']);
    Route::post('/stories/{id}/addChapter', [StoryController::class, 'addChapter']);
    Route::put('/stories/{id}/update', [StoryController::class, 'updateChapter']);
    Route::delete('/stories/{id}/chuong-{chapId}', [StoryController::class, 'deleteChapter']);



    
    Route::post('/stories/create', [StoryController::class, 'createStory']);
    
    Route::post('/category/create', [CategoryController::class, 'createCategory']);
    Route::post('/author/create', [CategoryController::class, 'createAuthor']);

    Route::get('/story/list', [StoryController::class, 'getListStory']);


    //Comments
    Route::get('/stories/{id}/comment',[CommentController::class, 'listComment']);
    Route::post('/stories/comment/{id}',[CommentController::class, 'createComment']);




});



Route::post('/login', [UserController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);

Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
