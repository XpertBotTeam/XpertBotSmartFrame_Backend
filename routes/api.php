<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PictureController;

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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('pictures', [PictureController::class, 'getAllPictures']);
Route::post('addPicture', [PictureController::class, 'addPicture']);
Route::get('/pictures/delete/{id}', [PictureController::class, 'deletePicture']);
Route::post('/pictures/update/{id}', [PictureController::class, 'updatePicture']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


