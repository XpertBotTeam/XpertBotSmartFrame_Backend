<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PictureController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\FrameController;
use App\Http\Controllers\API\CustomizedArtController;

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
Route::post('logout', [AuthController::class, 'logout']);

Route::get('pictures', [PictureController::class, 'getAllPictures']);
Route::post('addPicture', [PictureController::class, 'addPicture']);
Route::get('/picture/{id}', [PictureController::class, 'getPictureById']);
Route::get('pictureTypes', [PictureController::class, 'getPictureTypes']);
Route::get('/pictures/delete/{id}', [PictureController::class, 'deletePicture']);
Route::post('/pictures/update/{id}', [PictureController::class, 'updatePicture']);

Route::get('frames', [FrameController::class, 'getAllFrames']);
Route::post('addFrame', [FrameController::class, 'addFrame']);
Route::get('/frame/{id}', [FrameController::class, 'getFrameById']);
Route::get('frameTypes', [FrameController::class, 'getFrameTypes']);
Route::get('/frames/delete/{id}', [FrameController::class, 'deleteFrame']);
Route::post('/frames/update/{id}', [FrameController::class, 'updateFrame']);

Route::get('orders', [OrderController::class, 'getAllOrders']);
Route::post('addOrder', [OrderController::class, 'addOrder']);
Route::get('/order/{id}', [OrderController::class, 'getOrderById']);
Route::get('/orders/delete/{id}', [OrderController::class, 'deleteOrder']);
Route::post('/orders/update/{id}', [OrderController::class, 'updateOrder']);

Route::get('customizedArt', [CustomizedArtController::class, 'getAllcustomizedArt']);
Route::post('addCustomizedArt', [CustomizedArtController::class, 'addCustomizedArt']);
Route::get('/customizedArt/delete/{id}', [CustomizedArtController::class, 'deleteCustomizedArt']);
Route::post('/customizedArt/update/{id}', [CustomizedArtController::class, 'updateCustomizedArt']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


