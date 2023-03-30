<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/blogs',[BlogController::class,'getAllBlogs']);
Route::get('blogs/{id}', [BlogController::class,'getBlogs']);
Route::post('create-blogs', [BlogController::class,'createBlogs']);
Route::put('updateblogs/{id}', [BlogController::class,'updateBlog']);
Route::delete('deleteblogs/{id}',[BlogController::class, 'deleteBlogs']);

Route::post('login', [UserController::class, 'login']); 
Route::post('register', [UserController::class, 'register']); 
Route::group(['middleware' => 'auth:api'], function(){ 
  Route::post('user-details', [UserController::class, 'userDetails']); 
});
