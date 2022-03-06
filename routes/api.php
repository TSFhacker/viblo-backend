<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\CommentVoteController;


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

Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);
Route::post('addpost',[PostController::class, 'addPost']);
Route::get('list',[PostController::class, 'list']);
Route::post('getauthor',[UserController::class, 'getAuthor']);
Route::get('post/{post_id}',[PostController::class, 'getPost']);
Route::post('mark',[BookmarkController::class, 'mark']);
Route::post('bookmark',[BookmarkController::class, 'find']);
Route::post('bookmarklist',[BookmarkController::class, 'bookmarklist']);
Route::post('createcomment',[CommentController::class, 'create']);
Route::post('comment',[CommentController::class, 'show']);
Route::post('addpostvote',[PostVoteController::class, 'add']);
Route::post('findpostvote',[PostVoteController::class, 'find']);
Route::post('findpostvote2',[PostVoteController::class, 'find2']);
Route::post('updatepostvote',[PostVoteController::class, 'update']);
Route::post('addcommentvote',[CommentVoteController::class, 'add']);
Route::post('findcommentvote',[CommentVoteController::class, 'find']);
Route::post('findcommentvote2',[CommentVoteController::class, 'find2']);
Route::post('updatecommentvote',[CommentVoteController::class, 'update']);



