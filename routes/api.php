<?php

use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\UserController;
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

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/login', [UserController::class, 'login']);

Route::get('/users/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::put('/users/me', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/me', [UserController::class, 'delete'])->middleware('auth:sanctum');
Route::post('/users/me/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'index']);

Route::post('/users/me/notes', [NoteController::class, 'store'])->middleware('auth:sanctum');
Route::get('/users/me/notes', [NoteController::class, 'showByCurrentUser'])->middleware('auth:sanctum');
Route::put('/users/me/notes/{id}', [NoteController::class, 'update'])->middleware('auth:sanctum');

Route::get('/users/{id}/notes', [NoteController::class, 'showByUser']);

Route::get('/notes/{slug}', [NoteController::class, 'showBySlug']);
Route::get('/notes', [NoteController::class, 'index']);