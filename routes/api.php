<?php

use App\Http\Controllers\API\PostsController;
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

Route::get('posts', [PostsController::class, "index"]);
Route::post('posts', [PostsController::class, "store"]);
Route::get('posts/{id}', [PostsController::class, "show"]);
Route::post('posts/{id}', [PostsController::class, "update"]);
Route::get('posts/delete/{id}', [PostsController::class, "delete"]);