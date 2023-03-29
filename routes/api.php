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

Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/notes', [NoteController::class, 'showByUser']);

Route::get('/users/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::put('/users/me', [UserController::class, 'update'])->middleware('auth:sanctum');

Route::get('/users/{id}/notes', [NoteController::class, 'showByUser']);

Route::get('/notes/{slug}', [NoteController::class, 'showBySlug']);
Route::get('/notes', [NoteController::class, 'index']);